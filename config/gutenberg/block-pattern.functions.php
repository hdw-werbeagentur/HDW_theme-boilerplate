<?php
/*
** ------------------------------------------------------------------------------
** Unregister wordpress default block patterns
** ------------------------------------------------------------------------------
*/

remove_action( 'init', 'gutenberg_register_block_patterns' );
remove_action( 'init', '_register_core_block_patterns_and_categories' );