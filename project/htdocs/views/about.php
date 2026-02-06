<?php
$title = 'About - New Framework';
$pageJs = 'about';
if (isset($data)) extract($data);
require __DIR__ . '/partials/header.php';
?>
<section class="py-5" id="features">
    <div class="container px-5 my-5">
        <div class="row gx-5">
            <div class="col-lg-8 mx-auto mb-5 mb-lg-0">
                <h1>About Wordrift</h1>
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                What is Wordrift?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                Wordrift is my personal take on Wordle, built using the StrataPHP framework. It’s designed to be a fun and engaging way to practice coding and web development skills while enjoying a popular word game. With new features imnplemented and more planned, Wordrift is a project that combines my love for coding and gaming.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                How much does it cost?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <strong>Wordrift is free!</strong> (<i>Cool huh?</i>) It’s an open-source project that I’ve developed for fun and to share with the community. You can play it online at no cost, and if you’re interested in the code, it’s available on GitHub for anyone to explore, contribute to, or use as a learning resource.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                How can I contribute?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <p>Ideas are always welcome! If you have suggestions for new features, improvements, or want to help with development, you can contribute by submitting issues or pull requests on the GitHub repository. Whether you’re a seasoned developer or just starting out, your contributions are appreciated and can help make Wordrift even better.</p>
                                <p>You can drop me a line on my website, <a href="https://barrysmith.dev/contact/" title="go to my website" target="_blank">barrysmith.dev</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require __DIR__ . '/partials/footer.php'; ?>
