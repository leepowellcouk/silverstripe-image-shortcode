<?php
class ImageShortCode {
  public static function ImageShortCodeHandler($arguments, $caption = null, $parser = null) {
    if (empty($arguments['id'])) {
      return false;
    }

    $dir = realpath(__DIR__ . '/..');
    $img = DataObject::get_by_id('Image', $arguments['id']);

    if ($img && $img->exists()) {
        /*** SET DEFAULTS ***/
      $customise = array();
      $customise['Alt'] = "";
      $customise['Title'] = "";

      $customise = array_merge($customise, $arguments);
      $customise['Src'] = $img->URL;

      //get our Image template
      $template = new SSViewer(
        array(
          'Image',
          $dir . '/templates/Image'
        )
      );

      //return the customised template
      return $template->process(new ArrayData($customise));
    }

    return '';
  }
}
