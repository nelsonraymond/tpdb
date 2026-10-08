# DESIGN.md — Hijab E-Commerce Website

## 1. Design Overview

This document defines the visual and interaction system for the hijab e-commerce website.

### Brand Direction

The website should feel:

- Feminine
- Elegant
- Soft
- Modern
- Premium
- Warm
- Clean
- Trustworthy
- Aesthetic

Core visual concept:

> **Soft Luxury Feminine — a modern hijab boutique with subtle floral details.**

The design must NOT look childish, overly cute, overly pink, or like a generic marketplace.

The overall impression should be similar to a premium Indonesian fashion boutique.

---

# 2. Design Principles

## 2.1 Clean First

Prioritize product visibility and readability.

Do:
- Use generous whitespace.
- Keep layouts simple.
- Use clear visual hierarchy.
- Let product photography become the main visual focus.

Don't:
- Overdecorate every section.
- Use too many colors.
- Put floral illustrations behind important text.
- Use excessive shadows or gradients.

## 2.2 Feminine but Mature

Use pink as a brand identity, not as the only color.

The visual language should feel suitable for women aged approximately 17–35.

Avoid:
- Cartoon flowers
- Excessive hearts
- Bubble-style UI
- Neon pink
- Childish illustrations

Prefer:
- Botanical line-art
- Rose/petite flower illustrations
- Soft curves
- Editorial photography
- Elegant serif headings

## 2.3 Product Is the Hero

The products must always receive more attention than decorative elements.

Priority hierarchy:

1. Product
2. Product name / price
3. CTA
4. Supporting information
5. Decoration

---

# 3. Color System

Use CSS variables or Tailwind theme tokens so colors are easy to change globally.

## Primary Colors

```text
--primary-pink: #EFA7C1
--deep-pink: #D98FAF
--soft-pink: #F8C8DC
```

## Neutral Colors

```text
--cream: #FFF9F5
--white: #FFFFFF
--surface: #FCF7F8
--text-primary: #3A3033
--text-secondary: #75686D
--border: #EBDDE2
```

## Accent

```text
--gold: #C9A227
--mauve: #B97897
```

## Recommended Usage

- Background: `#FFF9F5` or `#FFFFFF`
- Primary CTA: `#D98FAF`
- Secondary CTA / hover: `#B97897`
- Soft section background: `#F8C8DC`
- Main text: `#3A3033`
- Secondary text: `#75686D`
- Borders: `#EBDDE2`
- Premium highlight: `#C9A227`

### Color Rule

Use approximately:

- 60% white/cream
- 25% soft pink
- 10% dusty/deep pink
- 5% accent gold

Pink should support the layout rather than dominate it.

---

# 4. Typography

Use a premium serif + clean sans-serif combination.

## Primary Heading Font

Preferred:

```text
Playfair Display
```

Alternative:

```text
Cormorant Garamond
```

Use for:
- Hero headline
- Section headings
- Brand statements
- Promotional headings

## Body/UI Font

Preferred:

```text
Poppins
```

Alternative:

```text
Inter
```

Use for:
- Product names
- Navigation
- Buttons
- Labels
- Forms
- Prices
- Body copy

## Typography Rules

Heading:
- Elegant
- High contrast
- Never overly bold

Body:
- Clean
- Highly readable
- Medium line height

Buttons:
- Sans-serif
- Medium/semibold
- Clear text

Example:

```text
Elegance in Every Wrap
```

"Elegance in Every Wrap" should use the serif font.

---

# 5. Logo & Brand Mark

Logo direction:

- Minimal wordmark
- Elegant serif typography
- Optional tiny floral symbol
- No complicated icon

Recommended appearance:

```text
[small floral mark]
BRAND NAME
```

The logo should work on:
- White background
- Cream background
- Pink background

Use deep pink or dark charcoal for the primary logo.

---

# 6. Floral Design System

Floral elements are a supporting visual language.

## Approved Floral Elements

Use:
- Rose line-art
- Peony line-art
- Small flowers
- Botanical leaves
- Thin stems
- Petal silhouettes
- Soft floral patterns
- Hand-drawn botanical accents

## Placement

Good locations:
- Hero corners
- Section corners
- Promotional banner
- Footer
- Empty states
- Decorative separators
- Around headings
- Background edges

Avoid placing flowers:
- Over product images
- Behind CTA text
- Over navigation
- Over form inputs

## Floral Style

Flowers should be:
- Thin-line
- Soft
- Elegant
- Slightly imperfect / organic
- Low contrast

Floral opacity:

```text
10% – 35%
```

Do not make decorative flowers the focal point.

---

# 7. Background System

Preferred backgrounds:

### Main

```text
#FFFFFF
```

### Soft Sections

```text
#FFF9F5
```

### Pink Sections

```text
#F8C8DC
```

### Promotional Sections

Use subtle pink gradients:

```text
linear-gradient(135deg, #FFF9F5, #F8C8DC)
```

Avoid strong gradients.

---

# 8. Spacing System

Use a consistent spacing scale.

Recommended Tailwind-style values:

```text
4px
8px
12px
16px
24px
32px
48px
64px
80px
96px
```

Desktop sections:

```text
padding-top: 80px
padding-bottom: 80px
```

Mobile sections:

```text
padding-top: 48px
padding-bottom: 48px
```

Use generous whitespace around:
- Hero
- Product grids
- Testimonials
- Promotional sections

---

# 9. Border Radius

Use soft but mature rounding.

Recommended:

```text
sm: 8px
md: 12px
lg: 16px
xl: 24px
pill: 9999px
```

Default:
- Cards: 16px
- Buttons: 12px
- Image containers: 16px
- Tags/badges: pill

Avoid excessive rounding that makes the UI look childish.

---

# 10. Shadows

Use very subtle shadows.

Default card shadow:

```text
0 8px 30px rgba(58, 48, 51, 0.06)
```

Hover:

```text
0 12px 35px rgba(58, 48, 51, 0.10)
```

Do not use strong black shadows.

---

# 11. Buttons

## Primary Button

Style:

- Background: deep pink
- Text: white
- Radius: 12px
- Medium weight
- Smooth hover

Example:

```text
SHOP NOW
```

Hover:
- Slightly darker pink
- Small upward movement
- Subtle shadow

## Secondary Button

- Transparent / white
- Deep pink border
- Deep pink text

Example:

```text
EXPLORE COLLECTION
```

## Text Button

For:
- View all
- Learn more
- Continue shopping

Use minimal styling with an arrow.

Example:

```text
View Collection →
```

---

# 12. Navigation

## Desktop Header

Layout:

```text
Logo | Home | Shop | Collections | About | Contact | Search | Wishlist | Cart | Account
```

Header style:
- White or cream background
- Sticky on scroll
- Thin bottom border
- Minimal shadow

Active navigation:
- Deep pink text
- Optional small underline

## Mobile Header

Layout:

```text
Hamburger | Logo | Search | Cart
```

Keep the header compact.

---

# 13. Hero Section

Hero should immediately communicate:

1. What the brand sells
2. Brand feeling
3. Main CTA

Recommended structure:

```text
[Headline]
Elegance in Every Wrap

[Supporting text]
Temukan hijab yang nyaman, elegan,
dan cocok untuk setiap momen.

[SHOP NOW]

               [Model wearing hijab]
         [subtle floral decoration]
```

Hero background:
- Cream
- Soft pink
- White

Use floral elements around the edges.

Do not place decorative objects directly over the model/product.

---

# 14. Category Cards

Categories:

- Pashmina
- Segi Empat
- Voal
- Satin
- Ceruty
- Instant
- Premium

Card style:

- Large product/fashion image
- Rounded 16px
- Category name below or overlay
- Small floral accent

Interaction:
- Hover image zoom: 1.03
- Smooth transition
- CTA appears subtly

---

# 15. Product Card

Every product card should contain:

- Product image
- Product name
- Price
- Discount price if applicable
- Rating
- Review count
- Wishlist icon
- Badge when needed
- Add to cart

Example:

```text
[PRODUCT IMAGE]
           ♡

BEST SELLER

Pashmina Silk Premium

★★★★★ 4.9 (128)

Rp89.000
Rp109.000

[Add to Cart]
```

Product image should have a clean background.

Do not put too much text inside the image.

---

# 16. Product Image Rules

Use consistent image ratios.

Recommended:

```text
4:5
```

for fashion/product photography.

Images should:
- Have good lighting
- Show texture
- Show true color
- Be high resolution
- Use consistent framing

Product gallery:
- Main image
- Detail image
- Lifestyle image
- Color/texture image

---

# 17. Product Detail Page

Structure:

```text
Breadcrumb

[Image Gallery]     [Product Information]

                    Product Name
                    Rating
                    Price
                    Discount
                    Color selector
                    Variant selector
                    Quantity
                    Add to Cart
                    Buy Now

                    Product Details
                    Material
                    Size
                    Care Guide

                    Reviews

                    Related Products
```

Make the purchase CTA visually dominant.

Sticky purchase CTA can be used on mobile.

---

# 18. Filter & Search UI

Filters:

- Category
- Color
- Material
- Price
- Rating
- Availability

Filter UI should be:
- Simple
- Fast
- Easy to reset

Desktop:
- Sidebar filter or top filter bar

Mobile:
- Bottom sheet filter

Search should support:
- Product names
- Categories
- Materials
- Colors

Add autocomplete suggestions.

---

# 19. Wishlist

Wishlist icon:

```text
♡
```

Filled:

```text
♥
```

Interactions:
- Smooth toggle animation
- Show toast notification

Example:

```text
Added to wishlist
```

---

# 20. Cart

Cart should clearly show:

- Product
- Variant
- Quantity
- Price
- Subtotal
- Discount
- Shipping
- Total

Primary CTA:

```text
CHECKOUT
```

Add recommendation below:

```text
Complete Your Look
```

---

# 21. Checkout

Checkout must be visually calm and distraction-free.

Recommended sections:

1. Contact information
2. Shipping address
3. Shipping method
4. Payment method
5. Order summary

Avoid unnecessary navigation during checkout.

Use:
- Clear labels
- Large input fields
- Visible validation
- Clear price summary

---

# 22. Review System

Reviews should show:

- Rating
- Customer name
- Date
- Review text
- Customer photo when available

Prioritize photo reviews.

Example badge:

```text
Verified Purchase
```

Photos should be displayed in a clean gallery.

---

# 23. Promotional Components

Use promotions sparingly.

Examples:

### New Collection

```text
New Collection
Discover your next favorite hijab.

[SHOP NOW]
```

### Discount

```text
20% OFF
Limited Time Only
```

### Free Shipping

```text
FREE SHIPPING
On selected orders
```

Use floral elements subtly inside banners.

---

# 24. Why Choose Us

Use 4–5 compact benefit cards:

```text
Premium Quality
Comfortable Materials
Fast Shipping
Secure Payment
Easy Returns
```

Icons should be:
- Minimal
- Line-based
- Rounded
- Consistent

Avoid colorful cartoon icons.

---

# 25. Testimonials

Design:

- Soft cream background
- Large quotation mark
- Customer photo
- Review
- Rating
- Customer name

Optional floral line-art in a corner.

---

# 26. Footer

Footer should contain:

### Brand

Short brand description.

### Navigation

- Shop
- Collections
- About
- Contact
- FAQ

### Customer Service

- Shipping
- Returns
- Order Tracking
- Payment

### Social

- Instagram
- TikTok
- WhatsApp

### Newsletter

```text
Get 10% OFF Your First Order
[Email Address]
[Subscribe]
```

Add subtle floral background line-art.

---

# 27. Admin Dashboard Visual Direction

The admin dashboard does NOT need the same decorative treatment as the customer storefront.

Use a more functional style:

- White
- Soft gray
- Dusty pink
- Dark charcoal

Dashboard priority:

1. Revenue
2. Orders
3. Customers
4. Inventory
5. Analytics

Charts should be simple and readable.

Use pink as the main highlight color.

---

# 28. Responsive Design

The website is mobile-first.

## Mobile

Width:

```text
320px – 767px
```

Priorities:
- Fast navigation
- Large touch targets
- Sticky cart / CTA where appropriate
- 2-column product grid
- Compact header

## Tablet

Width:

```text
768px – 1023px
```

Use:
- 2–3 product columns
- Wider spacing
- Expanded navigation where possible

## Desktop

Width:

```text
1024px+
```

Use:
- Max content width around 1200–1280px
- 4 product columns where appropriate
- Spacious hero section

---

# 29. Responsive Rules

Never allow:

- Horizontal scrolling
- Overlapping text
- Cropped CTA
- Tiny buttons
- Decorative flowers covering content

All layouts must gracefully collapse.

---

# 30. Animation & Microinteractions

Animations must feel elegant and subtle.

Use:

```text
duration: 200ms – 400ms
ease: ease-out
```

Examples:
- Product card hover
- Image zoom
- Button hover
- Wishlist toggle
- Toast notification
- Modal appearance
- Navigation transition

Avoid:
- Excessive bouncing
- Flashing
- Large parallax effects
- Slow page transitions

---

# 31. Loading States

Use skeleton loaders instead of blank screens.

Skeleton style:
- Soft cream/gray
- Rounded
- Low contrast

Examples:
- Product card skeleton
- Product detail skeleton
- Order list skeleton

---

# 32. Empty States

Empty states should feel friendly and branded.

Example wishlist:

```text
Your wishlist is waiting for its favorites.

[Explore Collection]

     subtle floral illustration
```

Do not overdecorate.

---

# 33. Error States

Error messages must be clear.

Bad:

```text
Error 500
```

Better:

```text
Something went wrong.

Please try again.
[Try Again]
```

Use floral decoration only as a subtle supporting element.

---

# 34. Toast / Notification Style

Toast:

- White/cream background
- Soft border
- Small shadow
- Rounded 12px
- Dark text
- Pink icon/accent

Examples:

```text
✓ Added to cart
♡ Added to wishlist
✓ Order placed successfully
```

---

# 35. Accessibility

The UI must remain accessible.

Requirements:

- Good text contrast
- Visible focus state
- Keyboard navigation
- Semantic HTML
- Alt text on product images
- Buttons must have clear labels
- Form fields must have labels
- Do not rely only on color to communicate status

---

# 36. Image & Asset Guidelines

Preferred visuals:

- Realistic fashion photography
- Soft studio lighting
- Neutral backgrounds
- Consistent product photography
- Elegant female styling
- Natural skin tone
- Premium editorial feel

Avoid:
- Low-resolution product images
- Heavy filters
- Oversaturated colors
- Inconsistent photography style
- Generic stock-photo appearance

---

# 37. Component Naming Convention

Use reusable components.

Suggested components:

```text
Navbar
MobileNavbar
HeroSection
CategoryCard
ProductCard
ProductGrid
FilterSidebar
SearchBar
WishlistButton
CartDrawer
PromoBanner
ReviewCard
TestimonialCard
NewsletterSection
Footer
Modal
Toast
Breadcrumb
Pagination
```

Do not duplicate component styles unnecessarily.

---

# 38. Tailwind CSS Direction

Use Tailwind CSS with reusable design tokens.

Example theme concept:

```js
colors: {
  pink: {
    soft: '#F8C8DC',
    DEFAULT: '#EFA7C1',
    deep: '#D98FAF',
    mauve: '#B97897',
  },
  cream: '#FFF9F5',
  gold: '#C9A227',
  ink: '#3A3033',
  muted: '#75686D',
  border: '#EBDDE2',
}
```

Do not scatter random hex values throughout components.

Use the design tokens instead.

---

# 39. UI Consistency Rules

Every component must follow the same:

- Border radius
- Typography scale
- Spacing
- Button behavior
- Color system
- Shadow system
- Icon style

Do not create one-off visual styles unless there is a clear product reason.

---

# 40. Do / Don't

## DO

- Use soft pink + cream
- Use elegant serif headings
- Use clean sans-serif body text
- Use premium product photography
- Use subtle floral line-art
- Use generous whitespace
- Use rounded cards
- Keep CTA obvious
- Make product information easy to scan
- Keep mobile UX excellent

## DON'T

- Don't make everything pink
- Don't use childish flowers
- Don't use too many gradients
- Don't overuse gold
- Don't add unnecessary animations
- Don't make cards too crowded
- Don't use low-contrast text
- Don't make the website look like a generic marketplace
- Don't allow floral elements to compete with products

---

# 41. Page-by-Page Visual Direction

## Home

Mood:
**Editorial + soft luxury**

Focus:
- Hero
- New collection
- Best seller
- Category
- Testimonials
- Instagram

## Shop

Mood:
**Clean + product-focused**

Focus:
- Search
- Filter
- Product grid

## Product Detail

Mood:
**Premium + informative**

Focus:
- Product photography
- Material
- Variant
- Reviews
- Purchase CTA

## Cart

Mood:
**Simple + functional**

Focus:
- Order summary
- Checkout CTA

## Checkout

Mood:
**Calm + trustworthy**

Focus:
- Forms
- Payment
- Order summary

## About

Mood:
**Warm + storytelling**

Focus:
- Brand story
- Founder
- Values
- Craftsmanship

## Admin

Mood:
**Functional + professional**

Focus:
- Data
- Orders
- Products
- Revenue
- Inventory

---

# 42. Brand Voice

Copy should sound:

- Warm
- Elegant
- Friendly
- Confident
- Modern

Avoid overly formal corporate language.

Preferred examples:

```text
Find your perfect wrap.
Elegance in every detail.
Made for your everyday moments.
Your next favorite hijab is waiting.
```

Avoid:

```text
BUY NOW!!!
SUPER CHEAP!!!
BEST PRICE!!!
```

---

# 43. Vibe Coding Instructions for AI

When implementing this design, the AI coding agent must follow these rules:

1. Read this `DESIGN.md` before creating or modifying UI.
2. Treat this document as the visual source of truth.
3. Do not invent a different color palette.
4. Do not introduce unrelated UI styles.
5. Reuse existing components before creating new ones.
6. Keep the UI responsive from the beginning.
7. Use Tailwind design tokens rather than repeated raw colors.
8. Keep floral decorations subtle.
9. Prioritize product clarity and conversion.
10. Test mobile and desktop layouts after every major UI change.
11. Maintain visual consistency across all pages.
12. Prefer reusable components over duplicated markup.
13. Avoid unnecessary dependencies for simple visual effects.
14. Use accessible semantic HTML.
15. Keep animations subtle and performance-friendly.

---

# 44. Definition of Done — UI

A page is considered visually complete when:

- It follows the color system.
- It follows the typography system.
- It uses consistent spacing.
- It uses the correct border radius.
- It uses the correct button styles.
- Product images maintain consistent proportions.
- Floral elements are subtle.
- Mobile layout works correctly.
- Tablet layout works correctly.
- Desktop layout works correctly.
- No horizontal overflow exists.
- Interactive states are implemented.
- Loading and empty states are handled.
- Accessibility basics are respected.

---

# 45. Final Design Goal

The finished website should make a customer feel:

> **"This brand is feminine, elegant, trustworthy, and premium — and I can easily find a hijab I like."**

The website should feel like a **real fashion brand**, not a generic CRUD e-commerce template.
