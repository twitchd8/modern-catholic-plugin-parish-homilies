# 🕊️ ParishPress Project

Part of the **ParishPress** suite — modern, modular WordPress tools for Catholic parish websites.

---

# ParishPress Homilies

![License: GPL-2.0-or-later](https://img.shields.io/badge/License-GPL--2.0--or--later-blue.svg)
![WordPress: 6.5+](https://img.shields.io/badge/WordPress-6.5%2B-21759b.svg)
![PHP: 7.4+](https://img.shields.io/badge/PHP-7.4%2B-777bbb.svg)

A WordPress plugin for organizing and publishing parish homilies. Provides a “Homilies” custom post type with sermon date, preacher, and audio URL fields. Includes a shortcode for embedding homily lists in any page or block theme. Ideal for parishes publishing weekly or seasonal messages.

---

## Features

- Custom post type `pp_homily` with an archive at `/homilies` (`show_in_rest: true`)
- Meta box fields for date (`_pp_homily_date`), preacher (`_pp_homily_preacher`), audio URL (`_pp_homily_audio`), video URL (`_pp_homily_video`), and notes/document URL (`_pp_homily_doc`) with media-library pickers
- Shortcode `[parishpress_homilies]` lists homilies ordered by date descending and renders audio players, video embeds (oEmbed or direct video), and notes links when present
- Block: **ParishPress Homilies** (`parishpress/homilies`) exposes the `limit` setting in the editor and renders through the shortcode
- Single homily pages automatically append any audio, video, or document links; if a video is set it can replace the featured image
- Minimal front-end CSS enqueued only on the public site; admin script enqueues media pickers on homily edit screens

---

## Shortcode

List recent homilies (default limit 5):

```text
[parishpress_homilies]
```

Limit how many homilies display:

```text
[parishpress_homilies limit="10"]
```

- `limit` (int): Number of homilies to list (default 5). Homilies are sorted by `_pp_homily_date` descending.

---

## Block

Add the **ParishPress Homilies** block in the editor to adjust the list length visually. The block uses the shortcode renderer for consistent output.

---

## Installation

1. Upload or clone `parishpress-homilies` into `wp-content/plugins/`.
2. Activate **ParishPress Homilies** from Plugins.
3. Add Homilies (`pp_homily`) with date, preacher, and media URLs, then place the shortcode or block where you want the list to appear.

---

## 📝 Changelog

0.2.0

- Initial commit.

---

## 🔑 License

Licensed under the GPL-2.0-or-later license.

---