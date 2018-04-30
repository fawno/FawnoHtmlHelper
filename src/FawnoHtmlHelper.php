<?php
	namespace Fawno\View\Helper;

	use Bootstrap\View\Helper\HtmlHelper;

	class FawnoHtmlHelper extends HtmlHelper {
		protected $fonts = [
			'glyphicon' => 'glyphicon glyphicon-',
			'fa' => 'fa fa-',
			'fas' => 'fas fa-',
			'fab' => 'fab fa-',
		];

    public function initialize (array $config) {
			parent::initialize($config);

			$this->setTemplates([
				'icon' => '<{{tag}} aria-hidden="true" class="{{font}}{{type}}{{attrs.class}}"{{attrs}}></{{tag}}>'
			]);
    }

		/**
		 * Create an icon using the template `icon`.
		 *
		 * ### Options
		 *
		 * - `templateVars` Provide template variables for the `icon` template.
		 * - Other attributes will be assigned to the wrapper element.
		 *
		 * @param string $icon Name of the icon.
		 * @param array $options Array of options. See above.
		 * @param string $opcions['tag'] Tag use for the icon, "i" for default
		 * @param string $opcions['font'] Font of the icon:
		 *                                "glyphicon" for default Twitter Bootstrap icon.
		 *                                "fa" for Font Awesome icon.
		 *
		 * @return string The HTML icon.
		 */
		public function icon($icon, array $options = []) {
			$tag = empty($options['tag']) ? 'i' : $options['tag'];
			$font = 'glyphicon glyphicon-';
			if (!empty($options['font']) and isset($this->fonts[$options['font']])) {
				$font = $this->fonts[$options['font']];
			}
			unset($options['tag']);
			unset($options['font']);

			$options += [
				'templateVars' => []
			];
			return $this->formatTemplate('icon', [
				'tag' => $tag,
				'font' => $font,
				'type' => $icon,
				'attrs' => $this->templater()->formatAttributes($options),
				'templateVars' => $options['templateVars']
			]);
		}

    /**
     *
     * Create a Font Awesome icon.
     *
     * @param $icon The type of the icon (search, pencil, etc.)
     * @param $opcions Options for icon
     * @param $opcions['tag'] Tag use for the icon, "i" for default
     *
    **/
    public function faIcon($icon, array $options = []) {
			$options['font'] = 'fa';
			return $this->icon($icon, $options);
    }
	}
