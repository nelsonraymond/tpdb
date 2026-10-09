<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

/**
 * Populates missing product images for development / academic demonstration.
 *
 * Source: curated hijab / modest-fashion photography from Pexels, defined in
 * DemoImageManifest.php (category slug -> verified photo id). Images are
 * DOWNLOADED INTO LOCAL STORAGE (public disk, `products/` prefix) — the site
 * never hotlinks to external URLs. Files render through the existing
 * Storage::url() pipeline once `php artisan storage:link` exists.
 *
 * IMPORTANT: these are stock/model photographs used as illustrative demo
 * imagery. They are NOT verified photos of the actual merchandise. Replace
 * them with real catalog photography before any production launch.
 * See DEMO-IMAGES.md for sources and license notes.
 *
 * Integrity guarantees:
 *  - Products that already have image records are NEVER touched (admin
 *    uploads stay intact — no overwriting, no duplicate rows on re-run).
 *  - Categories without an approved manifest entry are SKIPPED and reported;
 *    unrelated imagery is never substituted just to fill a card.
 *  - Only genuine JPEG payloads (magic-byte check) are stored; failed
 *    downloads create no DB rows and are safe to retry.
 *
 * Run: php artisan db:seed --class=ProductImageSeeder
 */
class ProductImageSeeder extends Seeder
{
    public function run(): void
    {
        $disk = Storage::disk('public');

        $products = Product::with('category')->orderBy('id')->get();

        foreach ($products as $product) {
            // Preserve every existing uploaded image record.
            if ($product->images()->exists()) {
                $this->command?->info("Skip  {$product->name} (already has images)");

                continue;
            }

            $slug = $product->category?->slug ?? '';
            $entry = DemoImageManifest::CATEGORY_PHOTOS[$slug] ?? null;

            if ($entry === null) {
                $this->command?->warn(
                    "PEND  {$product->name} — category '{$slug}' has no approved imagery yet. ".
                    'Add a curated entry to DemoImageManifest or upload via Admin. '.
                    '(Never auto-filled with unrelated photos.)'
                );

                continue;
            }

            $path = 'products/demo-'.$product->slug.'.jpg';

            if (! $disk->exists($path)) {
                $body = @file_get_contents(DemoImageManifest::cdnUrl($entry['pexels_id']));

                // Magic-byte check: only store genuine JPEG payloads.
                if ($body === false || strlen($body) < 5000 || substr($body, 0, 3) !== "\xFF\xD8\xFF") {
                    $this->command?->warn("FAIL  {$product->name} — download error (Pexels #{$entry['pexels_id']}). Re-run later.");

                    continue;
                }

                $disk->put($path, $body);
            }

            ProductImage::create([
                'product_id' => $product->id,
                'variant_id' => null,
                'image_path' => $path,
                'alt_text' => $product->name.' — '.$product->material.' (demo image)',
                'sort_order' => 0,
                'is_primary' => true,
            ]);

            $this->command?->info("Image {$product->name} <- Pexels #{$entry['pexels_id']} (category '{$slug}')");
        }

        $this->command?->info('Done. Pending categories: '.implode(', ', DemoImageManifest::PENDING_CATEGORIES));
    }
}
