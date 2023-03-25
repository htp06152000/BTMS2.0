
<?php if ( ! defined('ACCESS') ) die("Direct access not allowed."); ?>
            </div>
        </div>
    </main>
<footer class="footer container-fluid" id="footer">
    <?php if ((isset($_SESSION['message']) || isset($_GET['message'])) && $pagetitle != "Login") { ?>
        <div class="z-3 position-absolute" aria-live="polite" aria-atomic="true" style="min-height:200px;z-index:1;">
            <div class="z-3 position-fixed" style="top:1.5em;right:0.3em;">
                <div class="z-3 toast card-rounded animate__animated animate__bounceIn" role="alert" data-autohide="false" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header bg-transparent justify-content-between">
                        <div class="small font-weight-light text-<?=$_SESSION['messagetype']?>">
                            <i class="fas fa-bell"></i>
                            Notification.
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body fw-semibold">
                        <?=$_SESSION['message']?>
                    </div>
                </div>
            </div>
        </div>
    <?php unset($_SESSION['message']); } ?>
</footer>
<!-- Bootstrap core JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/ff82354aa1.js" crossorigin="anonymous"></script>
<script id="footer-scripts" type="text/javascript">
    jQuery.noConflict();
    ( ($)=> {
        $( ()=> {
            $(document).ready( ()=> {
                // General JS
                $('.toast').toast('show');
                $('[data-toggle="tooltip"]').tooltip();
                $("#menu-toggle").click(function(e) {
                    e.preventDefault();
                    $("#wrapper").toggleClass("toggled");
                });

                // Delete an item
                $('.has-itemid').on('show.bs.modal', function(e) {
                    //get data-id attribute of the clicked element
                    var itemid = $(e.relatedTarget).data('itemid');
                    //populate the textbox
                    $(e.currentTarget).find('input[name="itemid"]').val(itemid);
                });
                $(".has-itemid").on("hide.bs.modal", function () {
                    $(this).find('input[name="itemid"]').val("0");
                });
            });
        });
    })(jQuery);
</script>
<script src="https://kit.fontawesome.com/ff82354aa1.js" crossorigin="anonymous"></script>

