<?php

declare(strict_types=1);

namespace Christian\NttdataPacient\Setup\Patch\Data;

use Christian\NttdataPacient\Model\ResourceModel\Pacient;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchInterface;

class InitialPacient implements DataPatchInterface
{
  /**
   * InitialFaqs constructor.
   * @param ModuleDataSetupInterface $moduleDataSetupInterface
   * @param ResourceConnection $resourceConnection
   */
  public function __construct(
    protected ModuleDataSetupInterface $moduleDataSetupInterface,
    protected ResourceConnection $resourceConnection
  ) { }

  public static function getDependencies(): array
  {
    return [];
  }

  public function getAliases(): array
  {
    return [];
  }

  public function apply(): self
  {
    $connection = $this->resourceConnection->getConnection();
    $data = [
      [
        'NIf' => '12345678A',
        'nombre' => 'Pedro',
        'apellidos' => 'Gil',
        'telefono' => '123456789',
        'correo' => 'pedroGil@ejemplo.com',
        'localidad' => 'Zaragoza'
      ],
      [
        'NIf' => '12345678B',
        'nombre' => 'Juan',
        'apellidos' => 'Carlos',
        'telefono' => '987654321',
        'correo' => 'juanCarlos@ejemplo.com',
        'localidad' => 'Teruel'
      ],
      [
        'NIf' => '12345678C',
        'nombre' => 'Hector',
        'apellidos' => 'Gomez',
        'telefono' => '123987456',
        'correo' => 'hectorGomez@ejemplo.com',
        'localidad' => 'Huesca'
      ]
    ];

    $connection->insertMultiple(Pacient::MAIN_TABLE, $data);
    
    return $this;
  }
}