<div class="visible-print text-center">
    <?php echo QrCode::size(100)->generate(Request::url($shortUrl->shortUrl)); ?>

    <p>Scan me to return to the original page.</p>
</div>