<?php
/**
 * Template Name: My One Column
 * Template Post Type: store-news
 */

use Framework\Controller\Controller;

Controller::layout( 'one-column' );
Controller::render( 'content', 'post' );