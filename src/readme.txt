=== PreloadX - Custom Preloader ===
Contributors: vishwasr
Donate link: https://www.paypal.com/paypalme/vishwasr92
Tags: preloader, animation, loader, WordPress preloader, css loader
Requires at least: 5.0
Tested up to: 6.7
Requires PHP: 7.4
Stable tag: 1.1.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Customize your site's preloader with 17 modern CSS loaders, responsive percentage sizing, exit transitions, display rules, and custom background options.

== Description ==

Enhance your WordPress site with a fast, modern, and fully customizable preloader experience.

**PreloadX** allows you to seamlessly integrate a lightweight loading screen into your WordPress website. Choose from **17 high-performance, pure-CSS preloader styles**—ranging from classic spinners to futuristic 3D orbits and vector laser loops. Customize the background with solid colors, sleek gradients, or custom images, and tailor the preloader's accent color, size, and typography with real-time live preview.

Designed with modern web performance in mind, PreloadX features **zero external dependencies**, no heavy third-party scripts, and vanilla JavaScript for ultra-fast loading without slowing down your site.

= 🎨 17 Available Preloader Styles =

PreloadX organizes loaders in a clean, logical progression from classic essentials to advanced 3D animations and brand assets:

1. **Classic Spinner**: Clean, lightweight circular border spinner.
2. **Pulse Ring**: Expanding soft radial pulse ring with fading opacity.
3. **Double Bounce**: Dual harmonic bouncing spheres that scale in counter-phase.
4. **Wave Dots**: Three rhythmic bouncing dots in a smooth sine wave pattern.
5. **Spinning Square**: 3D tumbling geometric square plane with perspective flip.
6. **Rotating Chase**: Sophisticated circular array of orbiting and chasing dots.
7. **Real Progress Bar**: True linear page progress track with live percentage indicator.
8. **Equalizer Wave**: Audio frequency rhythm wave bars pulsing dynamically.
9. **Morphing Fluid Blob**: Organic, shape-shifting fluid liquid blob animation.
10. **Infinity Loop**: Luminous laser tracing a figure-8 path with glowing comet trails.
11. **3D Isometric Cube**: Futuristic 3D tumbling and folding isometric blocks.
12. **3D Celestial Orbit**: Glowing planetary nucleus with three tilted 3D elliptical orbits and orbiting satellites.
13. **Neon Radar Scanner**: High-tech circular radar sweep with range grid and glowing center blip.
14. **Cinematic Text Reveal**: Modern clip-path typography reveal for custom loading phrases.
15. **SVG Outline Drawing**: Dynamic stroke outline mask drawing of uploaded SVG shapes or logos.
16. **Custom Image / Logo**: Pulsing custom brand logo or image.
17. **None (Disabled)**: Turn off the preloader without deactivating the plugin.

= ⚡ Key Features & Capabilities =

* **Responsive Sizing (% and px)**: Seamlessly toggle between **Responsive Percentage (`10% - 200%`)** for automatic scaling across all screen sizes, and **Fixed Pixels (`20px - 400px+`)** for exact branding measurements.
* **Corner Radius Control**: Fine-tune the corner softness (`0px - 40px`) for square, cube, equalizer, progress bar, and custom image loaders.
* **Typography Scaling**: Direct slider control (`12px - 48px`) over typography sizes for Text Reveal and Progress Bar loaders.
* **Custom Color & Background Options**:
  * **Solid Color**: Pick any background color using the native color picker.
  * **Gradient Background**: Enter any valid CSS linear or radial gradient for modern aesthetics.
  * **Background Image**: Set any image URL for full-screen cover loading backgrounds.
  * **Preloader Accent Color**: Live color picker to adapt foreground animations to your brand.
* **Advanced Display Rules**:
  * **Hide on Mobile**: Automatically disable the preloader on mobile devices (`wp_is_mobile()`) to ensure instantaneous mobile performance.
  * **Show Only on Homepage**: Restrict the preloader strictly to your site's front page/home page, keeping subsequent internal page clicks instant.
* **Cinematic Exit Animations**: Choose how the loading screen transitions out when the page finishes loading:
  * **Fade Out** (smooth opacity dissolve)
  * **Slide Up** (curtain lifts upward)
  * **Split** (horizontal center-split reveal)
  * **Diagonal Wipe** (cinematic angled wipe transition)
  * **Scale Out** (modern zoom-in fade transition)
* **Minimum Load Time**: Guarantee the preloader displays for at least a specified duration (e.g., 500ms, 1000ms) to avoid jarring screen flashes on fast connections.
* **Fallback Close Button**: Optional dismiss button so visitors can close the preloader manually if a third-party asset hangs.
* **Modern Full-Width Dashboard**: Clean, card-clickable selection interface with real-time live preview and zero radio-button clutter.
* **Zero External Dependencies**: 100% self-contained pure CSS and Vanilla JavaScript (No jQuery dependency on public pages).
* **Compatible with All WordPress Themes**: Works with classic themes, block themes, and major page builders (Elementor, Divi, Beaver Builder, etc.).

== Installation ==

= Automatic Installation =

Automatic installation is the easiest option:

1. Log in to your WordPress dashboard.
2. Navigate to **Plugins > Add New**.
3. In the search box, enter **PreloadX - Custom Preloader**.
4. Click **Install Now**, then click **Activate**.
5. Navigate to the **PreloadX** menu in your WordPress admin sidebar to configure your settings.

= Manual Installation =

1. Download the `preloadx-custom-preloader.zip` file.
2. Log in to your WordPress dashboard and navigate to **Plugins > Add New > Upload Plugin**.
3. Choose the ZIP file and click **Install Now**.
4. Activate the plugin through the **Plugins** menu in WordPress.

== Frequently Asked Questions ==

= How do I choose and customize a preloader? =
Navigate to **PreloadX** in your WordPress admin menu. Click directly on any of the 17 preloader cards in the gallery to select it, customize dimensions, colors, or background, and click **Save Changes**.

= Can I size the loader in percentages or pixels? =
Yes! PreloadX includes an inline **% vs px** unit toggle next to the Loader Size slider. Percentage mode (`10% - 200%`) scales proportionally with the visitor's screen size across mobile and desktop. Pixel mode (`20px - 400px+`) gives you exact pixel precision.

= How do Display Rules work? =
Under the **Display Rules & Timing** section:
* Check **Hide on Mobile** to prevent the preloader from rendering on mobile devices.
* Check **Show only on Homepage** to run the preloader only when visitors arrive at your home page, keeping internal subpage navigation instant.

= What are Exit Animations? =
When your website completes loading, PreloadX smoothly dismisses the preloader using your chosen exit transition:
* **Fade Out**: Softly dissolves the preloader.
* **Slide Up**: Glides the preloader screen upwards like a theater curtain.
* **Split**: Splits the preloader horizontally from the center.
* **Diagonal Wipe**: Sweeps away at an angle.
* **Scale Out**: Zooms the preloader outward as your content appears.

= What is the Fallback Close Button? =
If your website loads third-party external scripts that take unusually long, enabling the **Close Button** provides visitors with an emergency close button in the corner to dismiss the preloader immediately.

= Can I use my company's custom logo? =
Yes! Select the **Custom Image / Logo** preloader card, paste the URL of your uploaded image, and adjust corner radius and sizing. PreloadX also includes an **SVG Outline Drawing** preloader that dynamically draws the silhouette of your logo mask.

= Does PreloadX slow down my website? =
No. PreloadX is engineered for maximum performance:
* 100% pure CSS animations for GPU-accelerated 60fps rendering.
* Vanilla JavaScript (zero jQuery dependency on the frontend).
* Zero external fonts, CDNs, or third-party script requests.

== Screenshots ==

1. Admin Dashboard with unified gallery, live preview, and dimension sliders.
2. Infinity Loop animation with continuous laser stroke drawing and glowing neon trail.
3. 3D Celestial Orbit animation with inclined 3D elliptical rings and satellites.
4. Neon Radar Scanner with animated sweep fan and center blip.
5. Real Progress Bar loader with live page load percentage.

== Changelog ==

= 1.1.0 =
* NEW: 17 high-performance pure-CSS preloader animations (Classic Spinner, Pulse Ring, Double Bounce, Wave Dots, Spinning Square, Rotating Chase, Real Progress Bar, Equalizer Wave, Morphing Fluid Blob, Infinity Loop, 3D Isometric Cube, 3D Celestial Orbit, Neon Radar Scanner, Cinematic Text Reveal, SVG Outline Drawing, Custom Image/Logo).
* NEW: Responsive Percentage (`%`) vs Fixed Pixels (`px`) Unit Toggle for loader sizing with no upper limit on pixel dimensions.
* NEW: Real-time Loader Dimensions & Typography controls (size, corner radius, and font scaling).
* NEW: Modern Full-Width Admin Dashboard with clean, card-clickable selection and instant live previews.
* NEW: Advanced Display Rules (Hide on Mobile, Show only on Homepage).
* NEW: Cinematic Exit Animations (Fade Out, Slide Up, Split, Diagonal Wipe, Scale Out).
* NEW: Minimum Load Time & Fallback Close Button options.
* TWEAK: Completely refactored frontend to Vanilla JavaScript with zero jQuery or external script dependencies.
* TWEAK: Combined General & Appearance with Preloader Gallery into an intuitive unified settings interface.
* FIX: Fixed SVG coordinate calculations for smooth continuous Infinity Loop trails on WordPress.
* FIX: Fixed circular spinners (Classic Spinner, Radar, Pulse Ring) from distorting at large sizes.
* FIX: Fixed frontend asset resolution and CSS rendering on public pages.
* FIX: Resolved WordPress Plugin Check (PCP) standards for languages domain path and variable prefixing.

= 1.0.0 =
* Initial release with 10 Preloaders.