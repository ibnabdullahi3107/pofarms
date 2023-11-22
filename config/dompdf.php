<?php

return array(
    'show_warnings' => false,
    'public_path' => null,
    'convert_entities' => true,
    'options' => [
        // Other options...

        /**
         * The default paper size.
         *
         * North America standard is "letter"; other countries generally "a4"
         *
         * @see CPDF_Adapter::PAPER_SIZES for valid sizes ('letter', 'legal', 'A4', etc.)
         */
        "default_paper_size" => "A4",

        /**
         * The default paper orientation.
         *
         * The orientation of the page (portrait or landscape).
         */
        'default_paper_orientation' => "portrait",

        /**
         * The default font family
         *
         * Used if no suitable fonts can be found. This must exist in the font folder.
         */
        "default_font" => "serif",

        /**
         * The location of the DOMPDF font directory
         *
         * The location of the directory where DOMPDF will store fonts and font metrics.
         */
        "font_dir" => storage_path('fonts'),

        /**
         * The location of the DOMPDF font cache directory
         *
         * This directory contains the cached font metrics for the fonts used by DOMPDF.
         */
        "font_cache" => storage_path('fonts'),

        /**
         * The location of a temporary directory.
         *
         * The directory specified must be writable by the webserver process.
         */
        "temp_dir" => sys_get_temp_dir(),

        /**
         * The PDF rendering backend to use.
         *
         * Valid settings are 'PDFLib', 'CPDF' (the bundled R&OS PDF class), 'GD' and
         * 'auto'.
         */
        "pdf_backend" => "CPDF",

        /**
         * PDFlib license key
         *
         * If you are using a licensed, commercial version of PDFlib, specify
         * your license key here. If you are using PDFlib-Lite or are evaluating
         * the commercial version of PDFlib, comment out this setting.
         */
        // "DOMPDF_PDFLIB_LICENSE" => "your license key here",

        /**
         * html target media view which should be rendered into pdf.
         */
        "default_media_type" => "screen",

        /**
         * The PDF rendering backend to use.
         */

        // Set default paper margin, padding, and border
        "margin_top" => 20,
        "margin_right" => 20,
        "margin_bottom" => 20,
        "margin_left" => 20,
    ],



);
