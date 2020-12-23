<?php

namespace Give\Receipt;

use ArrayAccess;
use InvalidArgumentException;
use Iterator;

/**
 * Class Section
 *
 * This class represent receipt section as object and you can add ass many as you want line items.
 *
 * @since 2.7.0
 * @package Give\Receipt
 */
class Section implements Iterator, ArrayAccess {
	/**
	 * Iterator initial position.
	 *
	 * @var int
	 */
	private $position = 0;

	/**
	 * Array of line item ids to use in Iterator.
	 * Note: this property helps to iterate over associative array.
	 *
	 * @var int
	 */
	private $lineItemIds = [];

	/**
	 * Section heading.
	 *
	 * @since 2.7.0
	 * @var string
	 */
	public $label = '';

	/**
	 * Section ID.
	 *
	 * @since 2.7.0
	 * @var string
	 */
	public $id = '';

	/**
	 * Array of detail item class names.
	 *
	 * @since 2.7.0
	 * @var LineItem[]
	 */
	private $lineItems = [];

	/**
	 * Section constructor.
	 *
	 * @param  string $id
	 * @param  string $label
	 */
	public function __construct( $id, $label ) {
		$this->id    = $id;
		$this->label = $label;
	}

	/**
	 * Get line items.
	 *
	 * @return LineItem[]
	 * @since 2.7.0
	 */
	public function getLineItems() {
		return $this->lineItems;
	}

	/**
	 * Add detail group.
	 *
	 * @param  array  $lineItem
	 * @param  string $position Position can be set either "before" or "after" to insert line item at specific position.
	 * @param  string $lineItemId
	 *
	 * @return LineItem
	 * @since 2.7.0
	 */
	public function addLineItem( $lineItem, $position = '', $lineItemId = '' ) {
		$this->validateLineItem( $lineItem );

		$icon = isset( $lineItem['icon'] ) ? $lineItem['icon'] : '';

		$lineItemObj = new LineItem( $lineItem['id'], $lineItem['label'], $lineItem['value'], $icon );

		if ( isset( $this->lineItems[ $lineItemId ] ) && in_array( $position, [ 'before', 'after' ] ) ) {
			// Insert line item at specific position.
			$tmp    = [];
			$tmpIds = [];

			foreach ( $this->lineItems as $id => $data ) {
				if ( 'after' === $position ) {
					$tmp[ $id ] = $data;
					$tmpIds[]   = $id;
				}

				if ( $id === $lineItemId ) {
					$tmp[ $lineItemObj->id ] = $lineItemObj;
					$tmpIds[]                = $lineItemObj->id;
				}

				if ( 'before' === $position ) {
					$tmp[ $id ] = $data;
					$tmpIds[]   = $id;
				}
			}

			$this->lineItems   = $tmp;
			$this->lineItemIds = $tmpIds;
		} else {
			$this->lineItems[ $lineItemObj->id ] = $lineItemObj;
			$this->lineItemIds[]                 = $lineItemObj->id;
		}

		return $lineItemObj;
	}

	/**
	 * Remove line item.
	 *
	 * @param  string $lineItemId
	 *
	 * @since 2.7.0
	 */
	public function removeLineItem( $lineItemId ) {
		$this->offsetUnset( $lineItemId );
	}

	/**
	 * Validate line item.
	 *
	 * @param  array $array
	 *
	 * @since 2.7.0
	 */
	protected function validateLineItem( $array ) {
		$required = [ 'id', 'label', 'value' ];
		$array    = array_filter( $array ); // Remove empty values.

		if ( array_diff( $required, array_keys( $array ) ) ) {
			throw new InvalidArgumentException(
				esc_html__(
					'Invalid receipt section line item. Please provide valid line item id, label, and value.',
					'give'
				)
			);
		}
	}

	/**
	 * Return current data.
	 *
	 * @return mixed
	 * @since 2.7.0
	 */
	public function current() {
		return $this->lineItems[ $this->lineItemIds[ $this->position ] ];
	}

	/**
	 * Update iterator position.
	 *
	 * @since 2.7.0
	 */
	public function next() {
		++ $this->position;
	}

	/**
	 * Return iterator position.
	 *
	 * @return int
	 * @since 2.7.0
	 */
	public function key() {
		return $this->position;
	}

	/**
	 * Return whether or not valid array position.
	 *
	 * @return bool|void
	 * @since 2.7.0
	 */
	public function valid() {
		return isset( $this->lineItemIds[ $this->position ] );
	}

	/**
	 * Set iterator position to zero when rewind.
	 *
	 * @since 2.7.0
	 */
	public function rewind() {
		$this->position = 0;
	}

	/**
	 * Set line item.
	 *
	 * @param  string $offset  LineItem ID.
	 * @param  array  $value  LineItem Data.
	 *
	 * @since 2.7.0
	 */
	public function offsetSet( $offset, $value ) {
		$this->addLineItem( $value );
	}

	/**
	 * Return whether or not line item id exist in line.
	 *
	 * @param  string $offset  LineItem ID.
	 *
	 * @return bool
	 * @since 2.7.0
	 */
	public function offsetExists( $offset ) {
		return isset( $this->lineItems[ $offset ] );
	}

	/**
	 * Remove line item from line.
	 *
	 * @param  string $offset  LineItem ID.
	 *
	 * @since 2.7.0
	 */
	public function offsetUnset( $offset ) {
		if ( $this->offsetExists( $offset ) ) {
			unset( $this->lineItems[ $offset ] );
			$this->lineItemIds = array_keys( $this->lineItems );
		}
	}

	/**
	 * Get line item.
	 *
	 * @param  string $offset  LineItem ID.
	 *
	 * @return LineItem|null
	 * @since 2.7.0
	 */
	public function offsetGet( $offset ) {
		return isset( $this->lineItems[ $offset ] ) ? $this->lineItems[ $offset ] : null;
	}
}
