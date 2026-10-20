=== Spindles ===
Contributors: adedayospindle, asasolutionsltd
Requires at least: 6.6
Tested up to: 7.1
Requires PHP: 7.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Tags: blog, custom-logo, custom-menu, featured-images, threaded-comments, translation-ready, wide-blocks, accessibility-ready, two-columns

Accessible, fast, builder-friendly theme with light and dark modes and optional WooCommerce, Elementor, ACF and Events Calendar support.

== Description ==

Spindles is a clean, accessible classic theme for blogs, business sites, portfolios and online shops. It works fully on its own with no plugins, and it cooperates with popular page builders and plugins when you add them.

**Highlights**

* Accessible by design: skip link, labelled landmarks, keyboard-operable menu, visible focus indicators, and default colors that meet WCAG 2.1 AA contrast in both light and dark modes.
* Fast and private: system fonts only, no third-party libraries, no external requests, no tracking and no cookies set by the theme.
* Design system: colors, font sizes, spacing and layout widths come from theme.json, so they appear in the block editor and Site Editor controls.
* Light and dark color modes, accent and text color pickers, and adjustable content width (760 to 1600 pixels).
* Header layouts (Standard, Centered, Minimal), optional sticky header, optional header button and site tagline.
* Footer with up to three widget columns or a compact layout, custom copyright text, and a back-to-top link.
* Blog list or grid layout, featured images, threaded comments and post navigation.
* Three page templates: Full Width, Builder Neutral (keeps header and footer) and Builder Canvas (no header or footer).
* Translation ready, with a bundled translation template.

**Works with (all optional)**

* WooCommerce: theme support, product gallery zoom, lightbox and slider, a responsive product grid, and breadcrumbs.
* Elementor Pro Theme Builder: header, footer, single and archive locations, with the skip link and main landmark preserved.
* Page builders such as Elementor, Divi, WPBakery and Visual Composer: use the Builder Neutral or Builder Canvas templates. Theme styles are scoped so they do not restyle builder content.
* Advanced Custom Fields: helper functions read ACF fields and fall back to normal post meta when ACF is not installed.
* Modern Events Calendar: light styling for event lists, grids and single events.

Nothing is loaded or required unless the plugin is active, and the theme never asks you to install a plugin.

**Menus and widget areas**

* Menus: Primary Navigation and Footer Navigation.
* Widget areas: Sidebar, Footer 1, Footer 2 and Footer 3.

**For developers**

Action hooks: `spindles_before_header`, `spindles_after_header`, `spindles_before_content`, `spindles_after_content`, `spindles_before_footer`, `spindles_after_footer`. Call `spindles_before_events()` and `spindles_after_events()` in custom event templates to fire `spindles_before_events` and `spindles_after_events`.

Filters: `spindles_content_width` (maximum embed width in pixels, default 760) and `spindles_shop_products_per_page` (WooCommerce products per page, default 12).

Template helpers for custom page templates: `spindles_get_dynamic_field()`, `spindles_the_dynamic_field()`, `spindles_dynamic_field_markup()` and `spindles_render_dynamic_details()`. They read ACF fields when available, otherwise post meta, and escape all output.

Body classes reflect your Customizer choices (for example `sp-mode-dark`, `sp-header-centered`, `sp-position-sticky`, `sp-blog-grid`) so you can target them in custom CSS.

A matching child theme, Spindles Child, is available for safe customizations.

**Documentation and support**

Guides, release notes and support: https://asasolutionsltd.com/

Source code, releases and issue tracker: https://github.com/adedayospindles/spindle

== Installation ==

1. In your WordPress admin, go to Appearance > Themes and click Add New Theme, then Upload Theme.
2. Choose the theme zip file, click Install Now, then Activate.
3. Go to Appearance > Menus, create a menu and assign it to Primary Navigation (and optionally Footer Navigation).
4. Go to Appearance > Customize > Spindles Design System to set colors, color mode, header, footer and blog layout.
5. Go to Appearance > Widgets to add content to the Sidebar and the three footer areas.
6. Optional: install the Spindles Child theme and activate it instead if you plan to add custom code or CSS.

To use a page template, edit a page and choose Full Width, Builder Neutral or Builder Canvas under Template in the page settings.

== Frequently Asked Questions ==

= Does Spindles require any plugin? =

No. Spindles works on its own. WooCommerce, Elementor, ACF and Modern Events Calendar support only activates when you install those plugins.

= Is Spindles a block theme? =

Spindles is a classic theme that uses theme.json for its design tokens. The block editor works as normal and picks up the theme colors, font sizes and widths.

= How do I use Spindles with Elementor, Divi, WPBakery or Visual Composer? =

Edit the page, choose the Builder Neutral template to keep your site header and footer, or Builder Canvas for a completely blank page that your builder controls. Elementor Pro Theme Builder templates for header, footer, single and archive pages are also supported.

= Where do I turn on dark mode? =

Go to Appearance > Customize > Spindles Design System > Brand & typography, then set Color mode to Dark.

= How do I add a button to the header? =

In Appearance > Customize > Spindles Design System > Header options, fill in both Header button label and Header button URL.

= The footer does not show my widgets. =

Add widgets under Appearance > Widgets in Footer 1, Footer 2 or Footer 3. Empty areas are hidden. Footer widgets are not shown when the Footer layout is set to Compact.

= How do I change the footer copyright text? =

Use Appearance > Customize > Spindles Design System > Footer options. Leave it empty to show the year and site name.

= Can I customize the theme safely? =

Yes. Use the Spindles Child theme, or add code to your own plugin using the hooks and filters listed above. Avoid editing the parent theme files, because updates will overwrite your changes.

= Is Spindles accessible? =

Spindles is built to meet WCAG 2.1 AA, includes the accessibility-ready tag, and has been checked with automated tools. Content you add (such as images without alt text) still needs your attention, so please test your own pages.

= Does Spindles collect data or load anything from other sites? =

No. See the Privacy section below.

= How do I translate the theme? =

Use the bundled file languages/spindles.pot with a tool such as Loco Translate or Poedit, or contribute translations at translate.wordpress.org once the theme is listed.

= Where can I find documentation and get support? =

Documentation and contact details are at https://asasolutionsltd.com/. Report bugs and request features at https://github.com/adedayospindles/spindle/issues. You can also post in the support forum for this theme on WordPress.org.

== Privacy ==

Spindles does not collect, store or transmit any personal data. It does not set cookies, does not load fonts, scripts or images from external servers, and does not include analytics or tracking. Features such as comments and search use standard WordPress functionality and follow your site's privacy settings.

== Changelog ==

= 2.1.1 =
* Added comments.php with threaded comments and distinct styling for post author comments.
* Added the Footer 2 and Footer 3 widget areas that the footer layout already expected.
* Added styles for WordPress core classes: alignment, captions, galleries, sticky posts and post author comments.
* Accessibility: improved dark-mode link contrast, focus indicator contrast and form field border contrast; unique labels for search forms; the back-to-top link now sits in its own landmark; "Read more" links now include the post title for screen readers.
* The mobile menu no longer depends on DOMContentLoaded, so it works with "delay JavaScript" optimizers, and the menu stays visible when JavaScript is unavailable.
* Elementor Theme Builder output is now wrapped in the main landmark so the skip link keeps working.
* WooCommerce pages now use the theme's main landmark, show breadcrumbs, and honor Elementor Single and Archive locations.
* Form, table and heading styles are scoped to the theme so page builder and plugin content is not restyled.
* Admin bar offset fixed for the sticky header on small screens.
* Readable, unminified CSS and JavaScript, and WordPress Coding Standards formatting throughout.
* Added $content_width, a translation template, license.txt and this readme.

= 2.1.0 =
* Initial release of the Spindles design system.

== Upgrade Notice ==

= 2.1.1 =
Adds comments.php, the Footer 2 and Footer 3 widget areas, accessibility fixes and WooCommerce landmark fixes. Requires WordPress 6.6 or later. If you added widgets to Footer 1 they are unchanged.

== Copyright ==

Spindles WordPress Theme, Copyright 2026 ASA Solutions.
Spindles is distributed under the terms of the GNU General Public License v2 or later. A copy is included in license.txt.

Spindles bundles no third-party code. All code, styles and images are original work by ASA Solutions and are released under the same license.

== Resources ==

* Fonts: the theme itself uses system font stacks only. No web fonts are bundled or loaded.
* Screenshot typography: screenshot.png was designed with the Josefin Sans and Lora typefaces (SIL Open Font License 1.1, https://openfontlicense.org/). They are rendered into the image only and are not bundled with the theme.
* Scripts: assets/js/navigation.js is original work by ASA Solutions, GPL-2.0-or-later. No third-party libraries are bundled.
* Styles: assets/css/*.css are original work by ASA Solutions, GPL-2.0-or-later.
* Images: screenshot.png is original work by ASA Solutions, GPL-2.0-or-later. It includes the ASA Solutions logo, which is the property of ASA Solutions and is used by its owner.
