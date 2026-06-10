<?php
/**
 * Render callback for KC Single Testimonial.
 */

if (empty($attributes['testimonialId'])) {
    return '';
}

$testimonial_id = absint($attributes['testimonialId']);

if (! $testimonial_id) {
    return '';
}

$testimonial = get_post($testimonial_id);

if (! $testimonial || 'testimonial' !== $testimonial->post_type) {
    return '';
}

$title = get_the_title($testimonial_id);

$testimonial_text = '';
$testimonial_role  = '';

if (function_exists('get_field')) {
    $testimonial_text = get_field('testimonial_text', $testimonial_id);
    $testimonial_role  = get_field('testimonial_role', $testimonial_id);
}

$featured_image = get_the_post_thumbnail(
    $testimonial_id,
    'medium',
    array(
        'class' => 'kc-single-testimonial__image',
    )
);

$wrapper_attributes = get_block_wrapper_attributes(
    array(
        'class' => 'kc-single-testimonial',
    )
);
?>

<article <?php echo $wrapper_attributes; ?>>
  <?php if ($featured_image) : ?>
  <div class="kc-single-testimonial__media">
    <?php echo $featured_image; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped?>
  </div>
  <?php endif; ?>

  <?php if ($testimonial_text) : ?>
  <div class="kc-single-testimonial__quote">
    <?php echo wpautop(esc_html($testimonial_text)); ?>
  </div>
  <?php endif; ?>

  <div class="kc-single-testimonial__meta">
    <h3 class="kc-single-testimonial__name">
      <?php echo esc_html($title); ?></h3>

    <?php if ($testimonial_role) : ?>
    <p class="kc-single-testimonial__role">
      <?php echo esc_html($testimonial_role); ?></p>
    <?php endif; ?>
  </div>
</article>