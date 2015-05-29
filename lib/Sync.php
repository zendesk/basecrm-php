<?php

namespace BaseCRM;

/**
 * BaseCRM\Sync
 *
 * BaseCRM Sync API V2 high-level wrapper.
 *
 * @package BaseCRM
 */
class Sync
{
  /**
   * @var boolean Constant representing acknowledged state.
   */
  const ACK = true;

  /** 
   * @var boolean Constant representing not acknowledged state.
   */
  const NACK = false;

  /**
   * @var string Device's UUID.
   * @ignore
   */
  private $deviceUUID;

  /**
   * @var \BaseCRM\Client BaseCRM client.
   * @ignore
   */
  private $client;

  /**
   * Instantiate a new high-level Sync wrapper instance.
   * 
   * @param \BaseCRM\Client BaseCRM API V2 client instance. 
   * @param string $deviceUUID Device's UUID for which to perform synchronization.
   */
  public function __construct($client, $deviceUUID)
  {
  }

  /**
   * Perform a full syncrhonization flow.
   * See the following example:
   * 
   * <code>
   * <?php
   * $client = new \BaseCRM\Client(['accessToken' => '<YOUR_PERSONAL_ACCESS_TOKEN>']);
   * $sync = new \BaseCRM\Sync($client, '<YOUR_DEVICES_UUID>');
   * $sync.fetch(function ($meta, $resource){
   *  $klass = classify($meta['type']); // e.g. \BaseCRM\User, \BaseCRM\Source etc..
   *  call_user_func($klass . $meta['sync']['event_type'], $resource) ? \BaseCRM\Sync::ACK : \BaseCRM\Sync::NACK;
   * });
   * ?>
   * </code>
   *
   * @param callable $callback Callback that will be called for every item in queue.
   *  Takes two input arguments: synchronization meta data and associated resource. 
   *  It must return either ACK or NACK|null.
   */
  public function fetch(callable $callback)
  {
    return;
  }
}
