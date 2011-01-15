<?php if (is_array($tickets)) { ?>
<?php if (isset($ticketsheader)) { echo "<div class=\"tickets_header\">$ticketsheader</div>"; } ?>
<table width="100%" cellpadding="2" border="0">
  <tr bgcolor>
    <th width="40"><?php echo lang("ticket") ?></th>
    <th><?php echo lang("summary") ?></th>
    <th width="75"><?php echo lang("type") ?></th>
    <th width="60"><?php echo lang("state") ?></th>
    <th width="115"><?php echo lang("category") ?></th>
    <th width="70" align="center"><?php echo ucfirst(lang("created by")) ?></th>
    <th width="70" align="center"><?php echo lang("assigned to") ?></th>
  </tr>
<?php foreach($tickets as $ticket) { ?>
  <tr class="<?php echo $ticket->getPriority(); ?>">
    <td><div><a href="<?php echo $ticket->getViewUrl() ?>"><?php echo $ticket->getId() ?></a></div></td>
    <td><?php echo $ticket->getSummary() ?></td>
    <td><?php echo lang($ticket->getType()) ?></td>
    <td><?php echo lang($ticket->getState()) ?></td>
    <td>
<?php if($ticket->getCategory()) { ?>
          <?php echo clean($ticket->getCategory()->getName()) ?>
<?php } // if{ ?>
    </td>
    <td><?php echo $ticket->getCreatedBy()->getDisplayName() ?></td>
    <td>
<?php if($ticket->getAssignedTo()) { ?>
          <?php echo clean($ticket->getAssignedTo()->getObjectName()) ?>
<?php } // if{ ?>
    </td>
  </tr>
<?php } // foreach ?>
</table>
<?php } // if{ ?>
