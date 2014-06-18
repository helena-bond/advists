<div class="view">
    <h3><?= $data->title; ?></h3>
    <?= $data->getFormatedContent(false); ?>
    <div style="display:block;">
        <?= implode(', ', $data->getLinks()); ?>
    </div>
</div>

<hr/>