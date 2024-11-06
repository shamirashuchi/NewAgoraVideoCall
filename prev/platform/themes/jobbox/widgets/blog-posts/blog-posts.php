<?php

use Botble\Widget\AbstractWidget;

class BlogPostsWidget extends AbstractWidget
{
    protected $widgetDirectory = 'blog-posts';

    public function __construct()
    {
        parent::__construct([
            'name' => __('Blog posts'),
            'description' => __('Blog posts widget.'),
            'type' => 'popular',
            'number_display' => 5,
        ]);
    }
}