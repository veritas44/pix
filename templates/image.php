<?php $this->layout('layout') ?>

<div class="image pb-3">
    <a target="_blank" href="<?= $image->getUrl('original') ?>">
        <img class="img-fluid mx-auto d-block border border-light" src="<?= $image->getUrl('large') ?>" />
    </a>
    <?php if (!empty($_SESSION['user']) && ($_SESSION['user']->isOwner($image) || $_SESSION['user']->isAdmin())): ?>
    <div class="actions p-3">
        <a class="btn btn-secondary" href="/edit/<?= $image->slug ?>">Modifier</a>
        <a class="btn btn-secondary delete" href="/delete/<?= $image->slug ?>">Supprimer</a>
    </div>
    <?php endif; ?>
    <div class="text-right text-muted pt-3">
        <i class="fa fa-eye-<?php if ($image->private): ?>slash<?php endif; ?>"></i> <?= $image->popularity ?> vues
        <?php if ($image->user): ?>
        &mdash;
        <i class="fa fa-user"></i> <a href="/user/<?= $this->e($image->user->username) ?>">@<?= $this->e($image->user->username) ?></a>
        <?php endif; ?>
        <?php if ($labels = $image->getLabels()): ?>
        &mdash;
        <i class="fa fa-tags"></i>
            <?php foreach ($labels as $label): ?>
            <a href="/tag/<?= $this->e($label) ?>">#<?= $this->e($label) ?></a>
            <?php endforeach; ?>
        <?php endif; ?>
        &mdash;
        <i class="fa fa-calendar"></i>
        <?= date('d/m/Y', strtotime($image->date)) ?>
    </div>
</div>

<div class="border border-light border-left-0 border-right-0 py-3">
    <div class="row px-3">
        <label class="col-12 font-weight-bold text-muted">Afficher l'image :</label>
        <input class="form-control col-7 col-sm-8 col-md-9 col-lg-10 rounded-0" id="image" type="text" value="<?= $image->getUrl() ?>" readonly="readonly" />
        <button class="btn btn-primary btn-clipboard col-5 col-sm-4 col-md-3 col-lg-2 rounded-0" data-clipboard-target="#image"><i class="fa fa-clipboard"></i> Copier</button>
    </div>
    <div class="row px-3 pt-3">
        <label class="col-12 font-weight-bold text-muted">Accéder à l'image :</label>
        <input class="form-control col-7 col-sm-8 col-md-9 col-lg-10 rounded-0" id="original" type="text" value="<?= $image->getUrl('original') ?>" readonly="readonly" />
        <button class="btn btn-primary btn-clipboard col-5 col-sm-4 col-md-3 col-lg-2 rounded-0" data-clipboard-target="#original"><i class="fa fa-clipboard"></i> Copier</button>
    </div>
    <div class="row px-3 pt-3">
        <label class="col-12 font-weight-bold text-muted">Insérer la miniature dans un forum :</label>
        <input class="form-control col-7 col-sm-8 col-md-9 col-lg-10 rounded-0" id="forum_thumbnail" type="text" value="[url=<?= $image->getUrl(); ?>][img]<?= $image->getUrl('small'); ?>[/img][/url]" readonly="readonly" />
        <button class="btn btn-primary btn-clipboard col-5 col-sm-4 col-md-3 col-lg-2 rounded-0" data-clipboard-target="#forum_thumbnail"><i class="fa fa-clipboard"></i> Copier</button>
    </div>
    <div class="row px-3 pt-3">
        <label class="col-12 font-weight-bold text-muted">Insérer l'image dans un forum :</label>
        <input class="form-control col-7 col-sm-8 col-md-9 col-lg-10 rounded-0" id="forum_image" type="text" value="[url=<?= $image->getUrl(); ?>][img]<?= $image->getUrl('medium') ?>[/img][/url]" readonly="readonly" />
        <button class="btn btn-primary btn-clipboard col-5 col-sm-4 col-md-3 col-lg-2 rounded-0" data-clipboard-target="#forum_image"><i class="fa fa-clipboard"></i> Copier</button>
    </div>
</div>

<?= $this->insert('shared::images', ['images' => $image->getRelatedImages()]) ?>
