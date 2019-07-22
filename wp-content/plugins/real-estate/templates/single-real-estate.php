<?php get_header();

echo 'Hello from a plugin single';

while( have_posts() ) {
    the_post();

    $acf_fields = get_fields();

    $gallery = $acf_fields['gallery']['sizes']['thumbnail'];
    $subtitle = $acf_fields['subtitle'];

    echo '<h3>' . $subtitle . '</h3>';
    echo '<img src="' . $gallery . '">';
}

get_footer();

