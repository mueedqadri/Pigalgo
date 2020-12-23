<h2>
    <?= _x('GDPR User logs', 'gdpr-framework'); ?>
</h2>
<hr>
<?php if (count($userlogData)): ?> 
<div class="userlog-scroll">
    <table class="gdpr-user-logs">
        <th><?= _x('S.no', 'gdpr-framework'); ?></th>
        <th><?= _x('User ID', 'gdpr-framework'); ?></th>
        <th><?= _x('User logs', 'gdpr-framework'); ?></th>
        <th><?= _x('Updated date', 'gdpr-framework'); ?></th>
        <?php $x=1;foreach ($userlogData as $item): 
            $data = unserialize($item->userlog);
            $userlog_data =(array)$data;
            unset($userlog_data['user_pass']);
            unset($userlog_data['user_activation_key']);
            unset($userlog_data['user_status']);
            $userid=$userlog_data['ID'];
            unset($userlog_data['ID']);
            ?>
            <tr>
                <td>            
                    <?php echo $x++;?>
                </td>
                <td>            
                    <?php echo $userid;?>
                </td>
                <td>
                <ul>
                    <?php
                    if($userlog_data){
                        foreach($userlog_data as $key => $detail){
                            echo "<li><strong>".$key. ":</strong> $detail</li>";
                        }
                    }
                    echo "</br>";?>
                    </ul>
                </td>
                <td>
                <?php echo $item->updated_at;?>
                
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    </div>
<?php else: ?>
    <p><?= _x('No User Logs', 'gdpr-framework'); ?>.</p>
<?php endif; ?>