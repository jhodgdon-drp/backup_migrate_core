<?php

/**
 * @file
 * Contains \BackupMigrate\Core\Plugin\PluginManagerInterface.
 */

namespace BackupMigrate\Core\Plugin;

use \BackupMigrate\Core\Config\ConfigInterface;

/**
 * Manage all of the available Plugins.
 */
interface PluginManagerInterface
{
  /**
   * Add an item to the manager
   *
   * @param \BackupMigrate\Core\Plugin\PluginInterface|object $item
   *    The source to add.
   * @param $id
   * @return
   */
  public function add(PluginInterface $item, $id);

  /**
   * Get the item with the given id.
   *
   * @param $id
   * @return \BackupMigrate\Core\Base\PluginInterface The item specified by the id or NULL if it doesn't exist.
   **/
  public function get($id);

  /**
   * Get a list of all of the items.
   *
   * @return \BackupMigrate\Core\Plugin\PluginInterface[] An ordered list of the sources, keyed by their id.
   */
  public function getAll();

  /**
   * Set the configuration for all plugins.
   *
   * @param ConfigInterface $config A configuration object containing only configuration for all plugins
   */
  // public function setConfig(ConfigInterface $config);

  /**
   * Get all plugins that implement the given operation.
   *
   * @param string $op The name of the operation.
   * @return \BackupMigrate\Core\Plugin\PluginInterface[]
   */
  public function getAllByOp($op);

  /**
   * Get the environment (essentially a dependency injection container for
   * interfacing with the consuming application)
   *
   * @return \BackupMigrate\Core\Services\EnvironmentInterface
   */
  public function getEnv();

  /**
   * Get the list of supported file types, optionally for the specified op.
   *
   * @param string|null $op
   *    The operation for which the file types are supported.
   * @return array
   */
  public function supportedFileTypes($op = NULL);

  /**
   * Call all plugins which support the given operation.
   *
   * If an operand is used it is passed to each operator and should be returned
   * by each one. Not all operations require an operand in which case this will
   * be NULL.
   *
   * Params is an array of extra params which may be used. Plugins should expect
   * these to be passed as a keyed array.
   *
   * @param string $op
   *    The name of the operation to be called.
   * @param mixed $operand
   *    If there in an object being operated on (eg. a backup file) it will be
   *    passed to each plugin in succession. If not then this will be NULL.
   * @param array $params
   *    Optional operation parameters as a key/value array
   * @return mixed
   */
  public function call($op, $operand = NULL, $params = array());

}
