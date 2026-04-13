<?php
// Return if no visible fields
global $thisclient;
if (!$form->hasAnyVisibleFields($thisclient))
    return;

$isCreate = (isset($options['mode']) && $options['mode'] == 'create');
?>
    <tr><td colspan="2"><hr />
    <div class="form-header" style="margin-bottom:0.5em">
    <h3><?php
    $form_title_raw = $form->getTitle();
    $form_title = Format::htmlchars($form_title_raw);
    if (!empty($GLOBALS['lpb_client_dynamic_form_i18n'])) {
        $form_title_id = $form_title_raw;
        if (strcasecmp($form_title_raw, 'Contact Information') === 0) {
            $form_title_id = 'Informasi kontak';
        }
        ?><span class="lpb-bilingual" data-id="<?php echo Format::htmlchars($form_title_id); ?>" data-en="<?php echo Format::htmlchars($form_title_raw); ?>"><?php echo Format::htmlchars($form_title_id); ?></span><?php
    } else {
        echo $form_title;
    }
    ?></h3>
    <div><?php echo Format::display($form->getInstructions()); ?></div>
    </div>
    </td></tr>
    <?php
    // Form fields, each with corresponding errors follows. Fields marked
    // 'private' are not included in the output for clients
    foreach ($form->getFields() as $field) {
        try {
            if (!$field->isEnabled())
                continue;
        }
        catch (Exception $e) {
            // Not connected to a DynamicFormField
        }

        if ($isCreate) {
            if (!$field->isVisibleToUsers() && !$field->isRequiredForUsers())
                continue;
        } elseif (!$field->isVisibleToUsers()) {
            continue;
        }
        ?>
        <tr>
            <td colspan="2" style="padding-top:10px;">
            <?php if (!$field->isBlockLevel()) { ?>
                <label for="<?php echo $field->getFormName(); ?>"><span class="<?php
                    if ($field->isRequiredForUsers()) echo 'required'; ?>"><?php
                if (!empty($GLOBALS['lpb_client_dynamic_form_i18n']) && ($n = $field->get('name'))) { ?>
                <span data-i18n-field="<?php echo Format::htmlchars($n); ?>"><?php
                }
                echo Format::htmlchars($field->getLocal('label'));
                if (!empty($GLOBALS['lpb_client_dynamic_form_i18n']) && ($n = $field->get('name'))) { ?>
                </span><?php
                }
            ?>
            <?php if ($field->isRequiredForUsers() &&
                    ($field->isEditableToUsers() || $isCreate)) { ?>
                <span class="error">*</span>
            <?php }
            ?></span><?php
                if ($field->get('hint')) { ?>
                    <br /><em style="color:gray;display:inline-block"><?php
                        echo Format::viewableImages($field->getLocal('hint')); ?></em>
                <?php
                } ?>
            <br/>
            <?php
            }
            if ($field->isEditableToUsers() || $isCreate) {
                $field->render(array('client'=>true));
                ?></label><?php
                foreach ($field->errors() as $e) { ?>
                    <div class="error"><?php echo $e; ?></div>
                <?php }
                $field->renderExtras(array('client'=>true));
            } else {
                $val = '';
                if ($field->value)
                    $val = $field->display($field->value);
                elseif (($a=$field->getAnswer()))
                    $val = $a->display();

                echo sprintf('%s </label>', $val);
            }
            ?>
            </td>
        </tr>
        <?php
    }
?>
