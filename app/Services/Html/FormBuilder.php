<?php namespace App\Services\Html;

class FormBuilder extends \Collective\Html\FormBuilder
{
    public function commonAdminTextField($name, $label, $errors, $labelOptions = array(), $inputOptions = array())
    {
        $labelOptions['class'] = array_key_exists('class', $labelOptions) ?  $labelOptions['class'] . ' col-sm-2 control-label' : 'col-sm-2 control-label';
        $inputOptions['class'] = array_key_exists('class', $inputOptions) ?  $inputOptions['class'] . '  form-control' : ' form-control';
        $inputOptions['placeholder'] = trim($label,': ');

        return sprintf(
            '<div class="form-group %s">%s<div class="col-sm-10">%s<p class="help-block">%s</p></div></div>',
            $errors->has($name) ? ' has-error' : '',
            parent::label($name, $label, $labelOptions),
            parent::text($name, old($name), $inputOptions),
            $errors->has($name) ? $errors->first($name) : ''
        );
    }

    public function commonAdminPasswordField($name, $label, $errors, $labelOptions = array(), $inputOptions = array())
    {
        $labelOptions['class'] = array_key_exists('class', $labelOptions) ?  $labelOptions['class'] . ' col-sm-2 control-label' : 'col-sm-2 control-label';
        $inputOptions['class'] = array_key_exists('class', $inputOptions) ?  $inputOptions['class'] . '  form-control' : ' form-control';
        $inputOptions['placeholder'] = trim($label,': ');

        return sprintf(
            '<div class="form-group %s">%s<div class="col-sm-10">%s<p class="help-block">%s</p></div></div>',
            $errors->has($name) ? ' has-error' : '',
            parent::label($name, $label, $labelOptions),
            parent::password($name, old($name), $inputOptions),
            $errors->has($name) ? $errors->first($name) : ''
        );
    }

    public function commonAdminEmailField($name, $label, $errors, $labelOptions = array(), $inputOptions = array(), $value = '')
    {
        $labelOptions['class'] = array_key_exists('class', $labelOptions) ?  $labelOptions['class'] . ' col-sm-2 control-label' : 'col-sm-2 control-label';
        $inputOptions['class'] = array_key_exists('class', $inputOptions) ?  $inputOptions['class'] . '  form-control' : ' form-control';
        $inputOptions['placeholder'] = trim($label,': ');

        $value = old($name) ? old($name) : $value;
        return sprintf(
            '<div class="form-group %s">%s<div class="col-sm-10">%s<p class="help-block">%s</p></div></div>',
            $errors->has($name) ? ' has-error' : '',
            parent::label($name, $label, $labelOptions),
            parent::text($name, $value, $inputOptions),
            $errors->has($name) ? $errors->first($name) : ''
        );
    }

    public function commonAdminNumberField($name, $label, $errors, $labelOptions = array(), $inputOptions = array())
    {
        $labelOptions['class'] = array_key_exists('class', $labelOptions) ?  $labelOptions['class'] . ' col-sm-2 control-label' : 'col-sm-2 control-label';
        $inputOptions['class'] = array_key_exists('class', $inputOptions) ?  $inputOptions['class'] . '  form-control' : ' form-control';
        $inputOptions['placeholder'] = trim($label,': ');

        return sprintf(
            '<div class="form-group %s">%s<div class="col-sm-10">%s<p class="help-block">%s</p></div></div>',
            $errors->has($name) ? ' has-error' : '',
            parent::label($name, $label, $labelOptions),
            parent::number($name, old($name), $inputOptions),
            $errors->has($name) ? $errors->first($name) : ''
        );
    }

    public function commonAdminSelectField($name, $label, $value_list, $errors, $labelOptions = array(), $inputOptions = array())
    {
        $labelOptions['class'] = array_key_exists('class', $labelOptions) ?  $labelOptions['class'] . ' col-sm-2 control-label' : 'col-sm-2 control-label';
        $inputOptions['class'] = array_key_exists('class', $inputOptions) ?  $inputOptions['class'] . '  form-control' : ' form-control';
        $inputOptions['placeholder'] = trim($label,': ');

        return sprintf(
            '<div class="form-group %s">%s<div class="col-sm-10">%s<p class="help-block">%s</p></div></div>',
            $errors->has($name) ? ' has-error' : '',
            parent::label($name, $label, $labelOptions),
            parent::select($name, old($name),$value_list,  $inputOptions),
            $errors->has($name) ? $errors->first($name) : ''
        );
    }

    public function commonAdminCheckboxField($name, $label, $value, $errors, $labelOptions = array(), $inputOptions = array())
    {
        $labelOptions['class'] = array_key_exists('class', $labelOptions) ?  $labelOptions['class'] . ' col-sm-2 control-label' : 'col-sm-2 control-label';

        return sprintf(
            '<div class="form-group %s">%s<div class="col-sm-10"><label>%s</label><p class="help-block">%s</p></div></div>',
            $errors->has($name) ? ' has-error' : '',
            parent::label($name, $label, $labelOptions),
            parent::checkbox($name,$value ,old($name), $inputOptions),
            $errors->has($name) ? $errors->first($name) : ''
        );
    }
//    public function submit($value = null, $options = [])
//    {
//        return sprintf('
//			<div class="form-group %s">
//				%s
//			</div>',
//            empty($options) ? '' : $options[0],
//            parent::submit($value, ['class' => 'btn btn-default'])
//        );
//    }

    public function destroy($text, $message, $class = null)
    {
        return parent::submit($text, ['class' => 'btn btn-danger btn-block ' . ($class ? $class : ''), 'onclick' => 'return confirm(\'' . $message . '\')']);
    }

    public function control($type, $colonnes, $nom, $errors, $label = null, $valeur = null, $pop = null, $placeholder = '')
    {
        $attributes = ['class' => 'form-control', 'placeholder' => $placeholder];
        return sprintf('
			<div class="form-group %s %s">
				%s
				%s
				%s
				%s
			</div>',
            ($colonnes == 0) ? '' : 'col-lg-' . $colonnes,
            $errors->has($nom) ? 'has-error' : '',
            $label ? $this->label($nom, $label, ['class' => 'control-label']) : '',
            $pop ? '<a href="#" tabindex="0" class="badge pull-right" data-toggle="popover" data-trigger="focus" title="' . $pop[0] . '" data-content="' . $pop[1] . '"><span>?</span></a>' : '',
            call_user_func_array(['Form', $type], ($type == 'password') ? [$nom, $attributes] : [$nom, $valeur, $attributes]),
            $errors->first($nom, '<small class="help-block">:message</small>')
        );
    }

    public function check($name, $label)
    {
        return sprintf('
			<div class="checkbox col-lg-12">
				<label>
					%s%s
				</label>
			</div>',
            parent::checkbox($name),
            $label
        );
    }

    public function checkHorizontal($name, $label, $value)
    {
        return sprintf('
			<div class="form-group">
				<div class="checkbox">
					<label>
						%s%s
					</label>
				</div>
			</div>',
            parent::checkbox($name, $value),
            $label
        );
    }

    public function selection($nom, $list = [], $selected = null, $label = null)
    {
        return sprintf('
			<div class="form-group" style="width:200px;">
				%s
				%s
			</div>',
            $label ? $this->label($nom, $label, ['class' => 'control-label']) : '',
            parent::select($nom, $list, $selected, ['class' => 'form-control'])
        );
    }
}