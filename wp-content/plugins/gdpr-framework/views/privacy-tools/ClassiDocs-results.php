<?php  if($ClassiDocsdata){
	$ClassiDocsdata = json_decode($ClassiDocsdata);
    if(isset($ClassiDocsdata->documents->documents)){
        $documents = $ClassiDocsdata->documents->documents;
    }
    if(isset($documents)):
        ?>
       <table id="classiDocs_dataTable" class="display">
        <thead>
        <tr>
            <th></th>
            <th colspan="3"><?= __('Previous Results', 'gdpr-framework'); ?></th>
            <th colspan="3"><?= __('Current Results', 'gdpr-framework'); ?></th>
            <th colspan="1"></th>
        </tr>
        <tr>
            <th class="text-center"><input class="flat" onchange="" type="checkbox"></th>
            <th>
                <?= __('Name', 'gdpr-framework'); ?>
            </th>
            <th>
                <?= __('Path', 'gdpr-framework'); ?>
            </th>
            <th>
                <?= __('Workstation', 'gdpr-framework'); ?>
            </th>
            <th>
                <?= __('Name', 'gdpr-framework'); ?>
            </th>
            <th>
                <?= __('Path', 'gdpr-framework'); ?>
            </th>
            <th>
                <?= __('Workstation', 'gdpr-framework'); ?>
            </th>
            <th>
                <?= __('Last Scan', 'gdpr-framework'); ?>
            </th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($documents as $document):?>
            <tr>
                <th class="text-center">
                    <input name="documentIds" value="<?= $document->id;?>" type="checkbox">
                </th>
                <td><?= $document->prevName;?></td>
                <td><?= $document->prevFilePath;?></td>
                <td><?= $document->prevWorkstation;?></td>
                <td><?= $document->name;?></td>
                <td><?= $document->filePath;?></td>
                <td><?= $document->workstation;?></td>
                <td><?php 
                $originalDate = $document->lastScan;
                echo  $lastScan = date("m/d/Y H:i:s", strtotime($originalDate));
                ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
        </table> 
    <?php else: ?>
        <p><?= _x('No ClassiDocs data found!', 'gdpr-framework'); ?>.</p>
    <?php endif; }?>