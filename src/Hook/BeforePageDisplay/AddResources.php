<?php

namespace BlueSpice\NamespaceCSS\Hook\BeforePageDisplay;

class AddResources extends \BlueSpice\Hook\BeforePageDisplay {
	protected function skipProcessing() {
		if( $this->getNamespace() < 0 ) {
			return true;
		}
		if( !$nsName = \MWNamespace::getCanonicalName( $this->getNamespace() ) ) {
			return true;
		}
		if( !$srcTitle = \Title::newFromText( $nsName.'_css', NS_MEDIAWIKI ) ) {
			return true;
		}
		if( !$srcTitle->exists() ) {
			return true;
		}
		return false;
	}

	protected function doProcess() {
		$srcTitle = \Title::newFromText(
			\MWNamespace::getCanonicalName( $this->getNamespace() ).'_css',
			NS_MEDIAWIKI
		);
		$this->out->addStyle( $srcTitle->getLocalUrl( [
			'action' => 'raw',
			'ctype' => 'text/css'
		]));
		return true;
	}

	protected function getNamespace() {
		$namespace = $this->out->getTitle()->getNamespace();
		if( $this->out->getTitle()->isTalkPage() ) {
			$namespace --;
		}
		return $namespace;
	}
}
