        </div> <!-- End of #content -->
        <footer class="sticky-footer bg-white py-3">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span><i class="fas fa-recycle text-success"></i> Hak Cipta &copy; RecycleSmart <?= date('Y') ?></span>
                </div>
            </div>
        </footer>
    </div> <!-- End of #content-wrapper -->
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Siap untuk keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Logout" di bawah jika Anda siap untuk mengakhiri sesi Anda saat ini.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-primary" href="<?= site_url('login/logout') ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets/js/sb-admin-2.min.js') ?>"></script>

    <!-- Page level plugins -->
    <!-- <script src="<?= base_url('assets/vendor/chart.js/Chart.min.js'); ?>"></script> -->

    <!-- Page level custom scripts -->
    <!-- <script src="<?= base_url('assets/js/demo/chart-area-demo.js'); ?>"></script> -->
    <!-- <script src="<?= base_url('assets/js/demo/chart-pie-demo.js'); ?>"></script> -->

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>
