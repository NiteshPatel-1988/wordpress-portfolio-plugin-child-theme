# WordPress Portfolio Plugin & Twenty Twenty-Four Child Theme

This repository includes:
- A **custom WordPress plugin** named `wp-portfolio` that adds a "Portfolio" custom post type with a responsive shortcode.
- A **child theme** based on the **Twenty Twenty-Four** theme that includes custom navigation, footer, and styling for the Portfolio items.

---

## 📦 Plugin Features – `wp-portfolio`

- 🔧 Registers a **Custom Post Type**: `Portfolio`
- 🗂️ Includes custom fields:
  - Project Name
  - Completion Date
  - Project URL
  - Description
- 🧩 Provides a shortcode `[portfolio]` to display Portfolio items in a responsive grid layout.
- 🔐 Follows WordPress coding standards with proper **sanitization and validation** for security.
- 💻 Responsive grid layout using HTML/CSS, and templates for frontend display.

---

## 🎨 Child Theme – `twentytwentyfour-child`

- 🧭 **Custom Navigation Menu** added to the header.
- 🔗 **Social Media Links** added in the footer.
- 🎨 Custom styling for the Portfolio post type to match the parent theme’s aesthetics.

---

## 📁 Folder Structure

```plaintext
wordpress-portfolio-plugin-child-theme/
│
├── plugin/
│   └── wp-portfolio/
│       ├── wp-portfolio.php
│       ├── css/
│       ├── js/
│       └── templates/
│
└── theme/
    └── twentytwentyfour-child/
        ├── style.css
        ├── functions.php
        ├── header.php (optional)
        ├── footer.php (optional)
        └── template-parts/
```

---

## 🚀 Installation Guide

### 🔌 Plugin Installation
1. Upload the `wp-portfolio` folder to `/wp-content/plugins/`
2. Activate the plugin from the WordPress dashboard.
3. Use the `[portfolio]` shortcode on any page to display portfolio items.

### 🎨 Theme Installation
1. Upload the `twentytwentyfour-child` folder to `/wp-content/themes/`
2. Make sure the Twenty Twenty-Four theme is installed.
3. Activate the child theme via **Appearance > Themes**.

---

## ✅ Requirements
- WordPress 6.1 or higher
- PHP 7.4 or higher
- Twenty Twenty-Four Theme (as parent theme)

---

## 📬 Contact
Developed by **Nitesh Patel**  
📧 Email: [niteshpatel1265@gmail.com](mailto:niteshpatel1265@gmail.com)

---

## 📄 License
This project is open-source and available under the [MIT License](LICENSE).
