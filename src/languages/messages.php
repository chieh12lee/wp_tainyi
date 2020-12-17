<?php

function get_template_messages()
{
    return [
        // 404 Page
        '404' => [
            'title' => __('404 - Page not found.', 'domo'),
            'body' => __('The page you have looked for does not exist.', 'domo'),
            'link_text' => __('Back to home page', 'domo'),
        ],

        // Article Component
        'article' => [
            'edit' => __('Edit', 'domo'),
        ],

        // Base Page
        'base' => [
            'no_content' => __('目前沒有內容', 'domo'),
        ],

        // Comment Form Page
        'comment_form' => [
            'name' => __('Name', 'domo'),
            'email' => __('Email', 'domo'),
            'website' => __('Website', 'domo'),
            'comment' => __('Comment', 'domo'),
            'comment_placeholder' => __('Enter your comment here...', 'domo'),
            'post_comment' => __('Post Comment', 'domo'),
            'reset' => __('Reset', 'domo'),
        ],

        // Comment Page
        'comment' => [
            'reply' => __('Reply', 'domo'),
        ],

        // Search Page
        'search' => [
            'no_results' => __('Sorry, No Results. Try your search again.', 'domo'),
        ],

        // Search Form Page
        'search_form' => [
            'search' => __('Search', 'domo'),
        ],

        // Single Password Page
        'single_password' => [
            'password' => __('Password', 'domo'),
            'submit' => __('Submit', 'domo'),
        ],

        // Single Page
        'single' => [
            'edit' => __('Edit', 'domo'),
            'comments' => __('Comments', 'domo'),
        ],
    ];
}