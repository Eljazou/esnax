<style>
    body { background: #f4f5fa; }

    .box-header {
        background: linear-gradient(135deg, #7b5ce8 0%, #9b6ef0 100%);
        padding: 24px 28px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border: none;
        border-radius: 16px;
        margin-bottom: 24px;
    }

    .box-header .title-wrap {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .box-header .icon-circle {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: rgba(255,255,255,0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .box-header .icon-circle svg {
        width: 22px;
        height: 22px;
        stroke: #fff;
    }

    .box-header h3.box-title {
        color: #fff !important;
        font-size: 20px;
        font-weight: 700;
        margin: 0 !important;
        width: auto !important;
    }

    .box-header .subtitle {
        color: rgba(255,255,255,0.85);
        font-size: 13px;
        margin-top: 2px;
        font-weight: 400;
    }

    .btn-add-modern {
        background: rgba(255,255,255,0.18);
        border: 1px solid rgba(255,255,255,0.4);
        color: #fff !important;
        border-radius: 10px;
        padding: 9px 18px;
        font-weight: 600;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: background 0.2s ease;
        text-decoration: none !important;
        white-space: nowrap;
    }

    .btn-add-modern:hover {
        background: rgba(255,255,255,0.3);
        color: #fff !important;
    }

    .btn-add-modern svg {
        width: 16px;
        height: 16px;
        stroke: #fff;
    }

    .profile-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(99, 60, 200, 0.08);
        overflow: hidden;
        margin-bottom: 20px;
    }

    .profile-card-header {
        background: #f2eefd;
        padding: 16px 18px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .profile-card-header .name-wrap {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
    }

    .profile-card-header .icon-circle-sm {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #8b6cf0, #6b46e5);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .profile-card-header .icon-circle-sm svg {
        width: 19px;
        height: 19px;
        stroke: #fff;
    }

    .profile-card-header .profile-name {
        color: #4a2fc9;
        font-weight: 700;
        font-size: 16px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .profile-card-actions {
        display: flex;
        gap: 8px;
        flex-shrink: 0;
    }

    .btn-outline-purple {
        background: #fff;
        border: 1px solid #d9cffb;
        color: #6b46e5 !important;
        border-radius: 8px;
        padding: 6px 12px;
        font-size: 13px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none !important;
        white-space: nowrap;
    }

    .btn-outline-purple:hover {
        background: #f2eefd;
        color: #4a2fc9 !important;
    }

    .btn-outline-purple svg {
        width: 13px;
        height: 13px;
    }

    .profile-card-body {
        padding: 4px 0;
    }

    .profile-card-body ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .profile-card-body ul li a {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 18px;
        text-decoration: none !important;
        border-bottom: 1px solid #f5f3fc;
    }

    .profile-card-body ul li:last-child a {
        border-bottom: none;
    }

    .type-label {
        display: flex;
        align-items: center;
        gap: 12px;
        color: #3a3a4a;
        font-size: 14px;
        font-weight: 500;
    }

    .type-label .type-icon {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: #f2eefd;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .type-label .type-icon svg {
        width: 16px;
        height: 16px;
        stroke: #6b46e5;
    }

    .objectif-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 34px;
        height: 26px;
        padding: 0 8px;
        border-radius: 20px;
        background: #16a35a;
        color: #fff;
        font-weight: 700;
        font-size: 13px;
    }

    .btn-affecter {
        display: inline-block;
        background: #fff;
        padding: 8px 28px;
        z-index: 99;
        position: relative;
        box-shadow: 0 1px 1px rgba(0,0,0,0.1);
        border-top: 1px solid rgba(218, 215, 215, 0.5);
        border-bottom: 2px solid #6b46e5;
        color: #6b46e5;
        font-weight: 600;
        text-decoration: none !important;
        border-radius: 0 0 10px 10px;
    }
</style>
<div class="box-header">
    <div class="title-wrap">
        <div class="icon-circle">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <circle cx="12" cy="12" r="6"></circle>
                <circle cx="12" cy="12" r="2"></circle>
            </svg>
        </div>
        <div>
            <h3 class="box-title"><?php echo __('Les Objectifs des profils'); ?></h3>
            <div class="subtitle"><?php echo __('Consultez et gérez les objectifs par profil'); ?></div>
        </div>
    </div>
    <?php if ($this->requestAction('/droits/getrole/Objectifprofiles/add') == 1):
        echo $this->Html->link(
            '<svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>' . __('Ajouter'),
            array('action' => 'add'),
            array('class' => 'btn-add-modern', 'escape' => false)
        );
    endif; ?>
</div>
<div class="row">
<?php
$data=array();
$i=0;
$name='';
foreach ($objectifprofiles as $objectifprofile)
{
		if($objectifprofile['Objectifprofile']['name']!=$name)
			$i=0;
        $data[$objectifprofile['Objectifprofile']['name']][$i]=$objectifprofile;
		$name=$objectifprofile['Objectifprofile']['name'];
        $i++;
}

// Icons rotated per card so profiles are visually distinguishable, purely cosmetic
$headerIcons = array(
    '<svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>',
    '<svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>',
    '<svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>',
    '<svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>',
    '<svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 20h20"></path><path d="M4 20V10l3-6 3 6v10"></path><path d="M11 20V8l3-4 3 4v12"></path></svg>',
);
$cardIndex = 0;

foreach ($data as $value) : ?>

    <div class="col-md-4" style="margin-bottom: 20px;">
        <div class="profile-card">
            <div class="profile-card-header">
                <div class="name-wrap">
                    <div class="icon-circle-sm">
                        <?php echo $headerIcons[$cardIndex % count($headerIcons)]; ?>
                    </div>
                    <span class="profile-name"><?php echo $value[0]['Objectifprofile']['name']; ?></span>
                </div>
                <div class="profile-card-actions">
                    <?php
                    if($this->requestAction('/droits/getrole/objectifprofiles/edit')==1)
                        echo $this->Html->link(
                            '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5z"></path></svg>' . __('Éditer'),
                            array('action'=>'edit',$value[0]['Objectifprofile']['name']),
                            array('class' => 'btn-outline-purple', 'escape' => false)
                        ); ?>
                    <?php
                    if($this->requestAction('/droits/getrole/objectifprofiles/delete')==1)
                        echo $this->Form->postLink(
                            '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>' . __('Supprimer'),
                            array('action' => 'delete', $value[0]['Objectifprofile']['name']),
                            array('class' => 'btn-outline-purple', 'escape' => false),
                            null,
                            __('Etes-vous sur de vouloir supprimer # %s?', $objectifprofile['Objectifprofile']['id'])
                        ); ?>
                </div>
            </div>
            <div class="profile-card-body">
                <ul>
                    <?php $info='';
                    foreach ($value as $v) {
                        $info =$info.",".$v['Type']['id']."||".$v['Objectifprofile']['objectif'];
                        $typeNameLower = strtolower($v['Type']['name']);
                        if (strpos($typeNameLower, 'decin') !== false || strpos($typeNameLower, 'médecin') !== false) {
                            $typeIcon = '<svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.29 1.51 4.04 3 5.5l7 7Z"></path></svg>';
                        } elseif (strpos($typeNameLower, 'pharma') !== false) {
                            $typeIcon = '<svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18.5 5.5a3 3 0 0 0-3-3h-7a3 3 0 0 0-3 3v13a3 3 0 0 0 3 3h7a3 3 0 0 0 3-3z"></path><line x1="9" y1="9" x2="15" y2="9"></line><line x1="12" y1="6" x2="12" y2="12"></line></svg>';
                        } elseif (strpos($typeNameLower, 'grossiste') !== false) {
                            $typeIcon = '<svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="8" width="16" height="13" rx="1"></rect><path d="M9 21V8"></path><path d="M4 8l2-5h12l2 5"></path></svg>';
                        } else {
                            $typeIcon = '<svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"></circle></svg>';
                        }
                        echo '<li><a href="#"><span class="type-label"><span class="type-icon">'.$typeIcon.'</span>'.h($v['Type']['name']).'</span><span class="objectif-badge">'.h($v['Objectifprofile']['objectif']).'</span></a></li>';
                    }; ?>
                </ul>
            </div>
        </div>
        <?php
        if(!empty($user_id))
        echo $this->Html->link('affecter',array('controller'=>'objectifs','action'=>'add',$user_id,$info),array('class'=>'btn-affecter')); ?>
    </div>
<?php $cardIndex++; endforeach; ?>
</div>
