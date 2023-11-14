<div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="<?php echo get_the_post_thumbnail_url() ?>">
                                        <div class="ep">18 / 18</div>
                                        <div class="comment"><i class="fa fa-comments"></i> <?php echo get_comments_number() ?></div>
                                        <div class="view"><i class="fa fa-eye"></i> 9141</div>
                                    </div>
                                    <div class="product__item__text">
                                        <ul>
                                            <!-- <li>Active</li>
                                            <li>Movie</li> -->

                                            <?php
                                            //    $args = array( 
                                            //     'hide_empty' => true,
                                            //     'taxonomy' => 'tax-category-anime',
                                            //     ); 
                                            //     $cates = get_terms( $args ); 
                                            //     $terms = the_terms($post->ID, 'tax-category-anime');

                                                $term_list = get_the_terms($post->ID, 'tax-category-anime');
                                                // var_dump($term_list);
                                                if (is_array($term_list)) {
                                                foreach ( $term_list as $cate ) {  ?>
                                                    <li><a class="text-white" href="<?php echo get_term_link($cate); ?>"><?php echo $cate->name; ?></a></li>
                                                    
                                                <?php }}
                                            ?>
                                        </ul>
                                        <h5><a href="<?php echo get_permalink() ?>"><?php echo the_title() ?></a></h5>
                                    </div>
                                </div>
                            </div>