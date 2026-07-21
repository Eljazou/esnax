<style type="text/css">
    /* Theme Customizations */
    :root {
        --theme-primary: #9b90e0;
        --theme-primary-hover: #7e71cf;
        --theme-primary-light: #f4f2fc;
        --theme-primary-pale: #ece7fb;
        --theme-border: #ece9f9;
        --theme-text-dark: #2d2b42;
        --theme-text-muted: #8b87a3;
        --theme-danger: #ef4444;
        --theme-danger-hover: #dc2626;
        --radius-xl: 16px;
        --radius-lg: 12px;
        --radius-sm: 8px;
    }

    /* Modern Box Card Component */
    .box {
        background: #ffffff;
        border: 1px solid var(--theme-border);
        border-radius: var(--radius-xl);
        box-shadow: 0 4px 18px rgba(155, 144, 224, 0.08);
        margin-bottom: 30px;
    }
    .box-header {
        padding: 24px 28px;
        border-bottom: 1px solid var(--theme-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .box-header h2 {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
        color: var(--theme-text-dark);
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Clean Info Tables */
    .box-body {
        padding: 24px 20px;
    }
    .box-body table.table {
        width: 100%;
        margin-bottom: 0;
        border-collapse: collapse;
    }
    .box-body th {
        width: 35%;
        color: var(--theme-text-muted);
        font-size: 13.5px;
        font-weight: 600;
        padding: 12px 15px !important;
        border-top: none !important;
        border-bottom: 1px dashed var(--theme-border);
        text-align: left !important;
    }
    .box-body td {
        color: var(--theme-text-dark);
        font-size: 14px;
        font-weight: 500;
        padding: 12px 15px !important;
        border-top: none !important;
        border-bottom: 1px dashed var(--theme-border);
        text-align: left !important;
    }
    .box-body tr:last-child th, 
    .box-body tr:last-child td {
        border-bottom: none;
    }

    /* Standardized Buttons */
    .btn-lavender-primary {
        background: var(--theme-primary) !important;
        color: #ffffff !important;
        border: none !important;
        border-radius: var(--radius-sm);
        padding: 8px 20px;
        font-weight: 600;
        font-size: 13.5px;
        transition: background 0.2s ease;
    }
    .btn-lavender-primary:hover {
        background: var(--theme-primary-hover) !important;
    }

    /* Polished Timeline Stream */
    ul.timeline {
        position: relative;
        margin: 0 0 30px 0;
        padding: 0;
        list-style: none;
    }
    ul.timeline:before {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        left: 31px;
        width: 4px;
        background: var(--theme-primary-pale);
        border-radius: 2px;
    }
    ul.timeline > li {
        position: relative;
        margin-right: 10px;
        margin-bottom: 20px;
    }
    ul.timeline > li:before, ul.timeline > li:after {
        content: " ";
        display: table;
    }
    ul.timeline > li:after {
        clear: both;
    }
    ul.timeline > li > .timeline-item {
        box-shadow: 0 2px 12px rgba(155, 144, 224, 0.05);
        border-radius: var(--radius-lg);
        background: #fff;
        color: var(--theme-text-dark);
        margin-left: 60px;
        margin-right: 15px;
        padding: 0;
        position: relative;
        border: 1px solid var(--theme-border);
    }
    ul.timeline > li > .timeline-itemTarget {
        margin-top: 0;
    }
    ul.timeline > li > .timeline-item > .time {
        color: var(--theme-text-muted);
        float: right;
        padding: 14px;
        font-size: 12px;
    }
    ul.timeline > li > .timeline-item > .timeline-header {
        margin: 0;
        color: var(--theme-text-dark);
        border-bottom: 1px solid var(--theme-border);
        padding: 12px 16px;
        font-size: 14px;
        line-height: 1.1;
        font-weight: 600;
    }
    ul.timeline > li > .timeline-item > .timeline-header > a {
        font-weight: 600;
        color: var(--theme-primary-hover);
    }
    ul.timeline > li > .timeline-item > .timeline-body {
        padding: 16px;
        font-size: 13.5px;
        line-height: 1.6;
        color: var(--theme-text-dark);
    }
    ul.timeline > li > .timeline-item > .timeline-footer {
        padding: 12px 16px;
        background-color: #fafbfe;
        border-top: 1px solid var(--theme-border);
        border-bottom-left-radius: var(--radius-lg);
        border-bottom-right-radius: var(--radius-lg);
    }
    ul.timeline > li > .fa {
        width: 30px;
        height: 30px;
        font-size: 14px;
        line-height: 30px;
        position: absolute;
        color: #666;
        background: #d2d6de;
        border-radius: 50%;
        text-align: center;
        left: 18px;
        top: 4px;
    }
    ul.timeline > li > .fa.bg-blue {
        background-color: var(--theme-primary-light) !important;
        color: var(--theme-primary-hover) !important;
    }
    ul.timeline > li > .fa.bg-gray {
        background-color: var(--theme-primary-pale) !important;
        color: var(--theme-primary-hover) !important;
    }
    
    /* Time Segment Badge */
    ul.timeline > .time-label > span {
        font-weight: 600;
        padding: 6px 16px;
        display: inline-block;
        background-color: var(--theme-primary) !important;
        color: #fff !important;
        border-radius: var(--radius-sm);
        box-shadow: 0 2px 8px rgba(155, 144, 224, 0.2);
        margin-left: 14px;
    }

    /* Timeline Action Small Buttons */
    .btn-timeline-action {
        padding: 4px 12px;
        font-size: 12px;
        font-weight: 600;
        border-radius: var(--radius-sm);
        display: inline-block;
        margin-right: 5px;
        text-decoration: none !important;
        transition: all 0.2s ease;
    }
    .btn-timeline-action.primary {
        background: var(--theme-primary-light);
        color: var(--theme-primary-hover);
    }
    .btn-timeline-action.primary:hover {
        background: var(--theme-primary);
        color: #ffffff;
    }
    .btn-timeline-action.danger {
        background: #ffebee;
        color: var(--theme-danger);
    }
    .btn-timeline-action.danger:hover {
        background: var(--theme-danger);
        color: #ffffff;
    }
</style>

<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="box">
            <div class="box-header">
                <h2>
                    <?php echo __('Prospect'); ?>
                    <?php echo $this->Html->link(__('Editer'), array('action' => 'edit'), array('class'=>'btn btn-lavender-primary'));?>
                </h2>
            </div>
            <div class="box-body">
                <div class="col-md-6">
                    <table class="table">
                        <tr>
                            <th><?php echo __('Id'); ?></th>
                            <td>: <?php echo h($prospect['Prospect']['id']); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo __('Tyncode'); ?></th>
                            <td>: <?php echo h($prospect['Prospect']['tyncode']); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo __('Societe'); ?></th>
                            <td>: <?php echo h($prospect['Prospect']['societe']); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo __('Devis'); ?></th>
                            <td>: <?php echo h($prospect['Prospect']['devis']); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo __('Nom'); ?></th>
                            <td>: <?php echo h($prospect['Prospect']['nom']); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo __('Prenom'); ?></th>
                            <td>: <?php echo h($prospect['Prospect']['prenom']); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo __('Adresse1'); ?></th>
                            <td>: <?php echo h($prospect['Prospect']['adresse1']); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo __('Adresse2'); ?></th>
                            <td>: <?php echo h($prospect['Prospect']['adresse2']); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo __('Ville'); ?></th>
                            <td>: <?php echo h($prospect['Prospect']['ville']); ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table">
                        <tr>
                            <th><?php echo __('Pays'); ?></th>
                            <td>: <?php echo h($prospect['Prospect']['pays']); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo __('Tel'); ?></th>
                            <td>: <?php echo h($prospect['Prospect']['tel']); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo __('Portable'); ?></th>
                            <td>: <?php echo h($prospect['Prospect']['portable']); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo __('Fax'); ?></th>
                            <td>: <?php echo h($prospect['Prospect']['fax']); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo __('Mail'); ?></th>
                            <td>: <?php echo h($prospect['Prospect']['mail']); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo __('Region'); ?></th>
                            <td>: <?php echo h($prospect['Prospect']['region']); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo __('Categorie'); ?></th>
                            <td>: <?php echo h($prospect['Prospect']['categorie']); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo __('Type'); ?></th>
                            <td>: <?php echo h($prospect['Prospect']['type']); ?></td>
                        </tr>
                        <tr>
                            <th>Date d'ajout</th>
                            <td>: <?php echo h($prospect['Prospect']['created']); ?></td>
                        </tr>
                    </table>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <!-- Timeline Segment -->
        <ul class="timeline">
            <?php foreach($rapports as $rapport) {
                // Keep development arrays safely handled or hidden out of UI bounds
                // debug($rapport); 
            } ?>
            
            <!-- timeline time label -->
            <li class="time-label">
                <span>10 Feb. 2014</span>
            </li>
            
            <!-- timeline item -->
            <li>
                <i class="fa fa-envelope bg-blue"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>
                    <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>
                    <div class="timeline-body">
                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                        quora plaxo ideeli hulu weebly balihoo...
                    </div>
                    <div class="timeline-footer">
                        <a class="btn-timeline-action primary">Read more</a>
                        <a class="btn-timeline-action danger">Delete</a>
                    </div>
                </div>
            </li>

            <!-- timeline end marker -->
            <li>
                <i class="fa fa-clock-o bg-gray"></i>
            </li>
        </ul>
    </div>
    <div class="col-md-1"></div>
</div>