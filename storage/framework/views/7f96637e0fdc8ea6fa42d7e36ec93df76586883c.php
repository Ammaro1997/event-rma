<?php if(session()->get('message')): ?>
    <script>showMessage('<?php echo e(\Session::get('message')); ?>');</script>
<?php endif; ?>

<?php if(config('attendize.google_analytics_id')): ?>
<script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                        (i[r].q = i[r].q || []).push(arguments)
                    }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

        ga('create', '<?php echo e(config('attendize.google_analytics_id')); ?>', 'auto');
        ga('require', 'displayfeatures');
        ga('send', 'pageview');
</script>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Attendize-master\resources\views/Shared/Partials/GlobalFooterJS.blade.php ENDPATH**/ ?>