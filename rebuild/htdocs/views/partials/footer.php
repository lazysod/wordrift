

        </main>
        <!-- Footer-->
        <footer class="bg-dark py-4 mt-auto">
            <div class="container px-5">
                <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                    <div class="col-auto">
                        <div class="small m-0 ">Copyright &copy; <?php echo date('Y') . ' <a href="https://lzy.link/lazysod" class="footer_link">Laysod</a> - Powered by <a href="https://strataphp.org" class="footer_link">Strata PHP Framework</a>'; ?></div>
                    </div>
                    <div class="col-auto">
                        <a class="link-light small" href="/privacy">Privacy</a>
                        <span class=" mx-1">&middot;</span>
                        <a class="link-light small" href="/terms">Terms</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->

        <script src="<?php echo App::config('base_url'); ?>/js/jquery/jquery.js"></script>
        <script src="<?php echo App::config('base_url'); ?>/js/validator.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!-- Cookie banner config for JS -->
        <script>
        window.cookieBannerConfig = {
            enabled: <?php echo json_encode(App::config('cookie_banner_enabled')); ?>,
            text: <?php echo json_encode(App::config('cookie_banner_text')); ?>
        };
        </script>
        <!-- Core theme JS-->
        <script src="<?php echo App::config('theme_path'); ?>/js/scripts.js"></script>
        <?php

        if (!empty($pageJs)) :
            if (isset($admin_page) && $admin_page == true) {
                // Load admin-specific JS if the admin page flag is set
                $js_path = App::config('js_path') . '/admin/' . $pageJs . '.js';
            } elseif (isset($pageJs) && !empty($pageJs)) {
                // Load page-specific JS if set
                $js_path = App::config('js_path') . '/' . $pageJs . '.js';
            }
            ?>
        <?php if( file_exists($js_path)){
            echo '<script src="' . $js_path . '"></script>';
        } ?>
        
        <?php endif; ?>
        </body>

        </html>