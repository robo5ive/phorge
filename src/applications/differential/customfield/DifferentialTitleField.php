<?php

final class DifferentialTitleField
  extends DifferentialCoreCustomField {

  public function getFieldKey() {
    return 'differential:title';
  }

  public function getFieldName() {
    return pht('Brief Description');
  }

  public function getFieldDescription() {
    return pht('Stores the title (brief description) of the revision.');
  }

  protected function readValueFromRevision(
    DifferentialRevision $revision) {
    if (!$revision->getID()) {
      return null;
    }
    return $revision->getTitle();
  }

  public function shouldAppearInPropertyView() {
    return true;
  }

  public function renderPropertyViewLabel() {
    return $this->getFieldName();
  }

  public function getStyleForPropertyView() {
    return 'block';
  }

  public function getIconForPropertyView() {
    return 'fa-header';
  }

  // 使用 Remarkup 渲染标题，使其中的任务引用（如 T123）能自动链接到 Maniphest
  public function renderPropertyViewValue(array $handles) {
    if (!strlen($this->getValue())) {
      return null;
    }

    return new PHUIRemarkupView($this->getViewer(), $this->getValue());
  }

}
