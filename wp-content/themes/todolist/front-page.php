<?php
    get_header();
?>
    <div class="container my-3">
        <div class="my-3">
            <form method="POST" id="request">
                <input type="hidden" name="todo_csrf" value="<?php echo wp_create_nonce('vicode-csrf') ?>" />
                <div class="btn-group w-100">
                    <input type="text" class="form-control" id="post_title" name="post_title" placeholder="Add Todo ..." autocomplete="off" required />
                    <?php
                    // for non-JS browsers
                        if($_POST['post_title']) {
                            ?>
                                <script type="text/javascript">
                                    document.getElementById("post_title").focus();
                                </script>
                            <?
                        }
                    ?>
                    <button style="width:101px" type="submit" class="btn btn-success">Add Todo</button>
                </div>
            </form>
        </div>
        <table class="table table-hover">
            <tbody>
                <?php
                    the_post();
                    $args = array(
                        'post_type' => 'todoes',
                        'posts_per_page' => -1
                    );
                    $the_query = new WP_Query( $args );

                    if ( $the_query->have_posts() ){
                        while ( $the_query->have_posts() ) {
                            $the_query->the_post();
                            get_template_part('template-parts/content','todo');
                        }
                        wp_reset_postdata();
                    }else{
                        echo '<p class="text-danger">Todo list is currently empty !</p>';
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php
    get_footer();
?>
