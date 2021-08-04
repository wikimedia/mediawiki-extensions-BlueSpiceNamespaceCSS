<?php

namespace BlueSpice\NamespaceCSS\HookHandler;

use BlueSpice\NamespaceCSS\GlobalActionsManager;
use MWStake\MediaWiki\Component\CommonUserInterface\Hook\MWStakeCommonUIRegisterSkinSlotComponents;

class Main implements MWStakeCommonUIRegisterSkinSlotComponents {

	/**
	 * @inheritDoc
	 */
	public function onMWStakeCommonUIRegisterSkinSlotComponents( $registry ): void {
		$registry->register(
			'GlobalActionsManager',
			[
				'special-bluespice-namespacecss' => [
					'factory' => function () {
						return new GlobalActionsManager();
					}
				]
			]
		);
	}
}
