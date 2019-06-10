<ul class="nav">
    <li>
        <a href="<?= base_url(); ?>customers/dashboard/">
            <i class="glyphicon glyphicon-user"></i>
            Dashboard</a>
    </li>
    <li>
        <a href="<?= base_url(); ?>customers/edit_profile/<?php echo $this->session->userdata("id"); ?>">
            <i class="glyphicon glyphicon-user"></i>
            Account Settings </a>
    </li>

</ul>