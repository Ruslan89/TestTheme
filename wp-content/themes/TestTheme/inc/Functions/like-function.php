<?php

//Like Function. 'likeFunction' kann überall verwendet werden
function likeFunction($args = NULL) {
$likeCount = new WP_Query(array(
              'post_type' => 'like',
              'meta_query'=> array(
                array(
                  'key'     => 'like_id',
                  'compare' => '=',
                  'value'   => get_the_ID()
                )
              )
            ));

            $existStatus = 'no';

            if (is_user_logged_in()) {
              $existQuery = new WP_Query(array(
              'author'    => get_current_user_id(),
              'post_type' => 'like',
              'meta_query'=> array(
                array(
                  'key'     => 'like_id',
                  'compare' => '=',
                  'value'   => get_the_ID()
                )
              )
            ));

              if ($existQuery->found_posts) {
                $existStatus = 'yes';
              }
            }            
          ?>

          <span class="like-box" data-like="<?php echo $existQuery->posts[0]->ID; ?>" data-heilmittel="<?php the_ID(); ?>" data-exists="<?php echo $existStatus; ?>">
            <i class="fa fa-heart-o aria-hidden='true"></i>
            <i class="fa fa-heart aria-hidden='true"></i>
            <span class="like-count"><?php echo $likeCount->found_posts; ?></span>
          </span>
          <?php }