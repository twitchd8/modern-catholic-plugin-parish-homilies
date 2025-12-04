# ParishPress Homilies

![License: GPL-2.0-or-later](https://img.shields.io/badge/License-GPL--2.0--or--later-blue.svg)

ParishPress Homilies adds a **Homilies** custom post type with sermon date, preacher, audio, video, and notes/document support. List recent homilies with a shortcode or block, play audio/video inline, and surface notes links automatically on single homily pages.

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
