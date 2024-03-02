<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Client;
use App\Entity\Employee;
use App\Entity\Material;
use App\Entity\Order;
use App\Entity\OrderProduct;
use App\Entity\Product;
use App\Entity\QualityProduct;
use App\Entity\Service;
use App\Entity\Status;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $userPasswordHasherInterface;

    public function __construct(UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        $this->userPasswordHasherInterface = $userPasswordHasherInterface;
    }
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // Catégory
        $mainCategories = [
            "Hommes" => [
                "Chemises" => ["Chemise en coton", "Chemise à carreaux", "Chemise formelle"],
                "Pantalons" => ["Jean", "Pantalon chino", "Pantalon de costume"],
                "Pulls" => ["Pull en laine", "Sweat à capuche", "Pull col roulé"],
            ],
            "Femmes" => [
                "Robes" => ["Robe d'été", "Robe de soirée", "Robe maxi"],
                "Jupes" => ["Jupe crayon", "Jupe plissée", "Jupe longue"],
                "Ensembles" => ["Ensemble jupe et haut", "Ensemble pantalon et top", "Ensemble robe et veste"],
            ],
            "Enfants" => [
                "T-shirts" => ["T-shirt imprimé", "T-shirt à manches longues", "T-shirt basique"],
                "Shorts" => ["Short en jean", "Short de sport", "Short en coton"],
                "Pyjamas" => ["Pyjama deux pièces", "Chemise de nuit", "Combinaison pyjama"],
            ],
        ];

        // $productsEntities = [];
        $counter = 0;

        foreach ($mainCategories as $mainCategoryLabel => $subCategories) {
            $mainCategory = new Category();
            $mainCategory->setCategoryName($mainCategoryLabel);
            $manager->persist($mainCategory);

            foreach ($subCategories as $subCategoryLabel => $products) {
                $subCategory = new Category();
                $subCategory->setCategoryName($subCategoryLabel);
                $subCategory->setParentCat($mainCategory); 
                $manager->persist($subCategory);
     //products

    
                foreach ($products as $productName) {
                    $product = new Product();
                    $product
                        ->setNameProduct($productName)
                        ->setPrice($faker->randomFloat(2))
                        ->setCategory($subCategory);
                    $manager->persist($product);
                    $productsEntities[] = $product;

                    $counter++;

                    // Vérifiez si le compteur atteint 10, si oui, sortez de la boucle
                    if ($counter >= 10) {
                        break;
                    }

                }
            
                $mainCategory->addChild($subCategory);
            }
            $manager->persist($mainCategory);
        }

        $substances = ["Soie", "Coton", "Lin", "Polyester", "Cuir", "Autres"];
        $materialEntities = [];

        foreach ($substances as $substanceName) {
            $substance = new Material();
            $substance->setMaterialName($substanceName)
                ->setCoeff($faker->randomFloat(1, 1, 2));
            $manager->persist($substance);
            $materialEntities[] = $substance;

        }
        // clients
        $clients = [];
        for ($i = 0; $i < 10; $i++) {
            $client = new Client();
            $client->setEmail($faker->email());
            $client->setPassword($this->userPasswordHasherInterface->hashPassword(
                $client,
                "test_pass"
            )
            );
            $client->setFirstName($faker->firstName());
            $client->setLastname($faker->lastName());
            $client->setBirthday($faker->dateTimeBetween('-35 years', 'now'));
            $client->setStreetName($faker->address());
            $client->setStreetNumber($faker->randomNumber);
            $client->setTown($faker->randomElement());
            $client->setDistrict($faker->randomElement());
            $client->setCountry($faker->randomElement());
            $client->setClientNumber($faker->randomNumber());
            // $client->setRoles(['ROLE_CLIENT']);

            $manager->persist($client);
            $clients[] = $client;
        }

        // employées
        $employees = [];
        for ($i = 0; $i < 3; $i++) {
            $employee = new Employee();
            $employee->setEmail($faker->email());
            $employee->setPassword($this->userPasswordHasherInterface->hashPassword(
                $employee,
                "test_pass"
            )
            );
            $employee->setFirstName($faker->firstName());
            $employee->setLastname($faker->lastName());
            $employee->setBirthday($faker->dateTimeBetween('-40 years', 'now'));
            $employee->setStreetName($faker->address());
            $employee->setStreetNumber($faker->randomNumber);
            $employee->setTown($faker->randomElement());
            $employee->setDistrict($faker->randomElement());
            $employee->setCountry($faker->randomElement());
            $employee->setIsAdminRole($faker->boolean(3));
            $employee->setEmpNumber($faker->randomNumber('1', '5'));
            //    $employee->setRoles(['ROLE_ADMIN', 'ROLE_EMPLOYEE']);
            $manager->persist($employee);
            $employees[] = $employee;
        }
        // orders
        for ($i = 0; $i < 10; $i++) {
            $order = new Order();
            $order->setDateOrder($faker->dateTimeThisMonth());
            $order->setDateRender($faker->dateTimeThisMonth());
            $order->setClient($faker->randomElement($clients));
            $manager->persist($order);

        }
        //qualityproduct

        for ($i = 0; $i < 10; $i++) {
            $qualityProduct = new QualityProduct();
            $qualityProduct->setStatusName($faker->word);

            $manager->persist($qualityProduct);
        }
        //services
        $pressingServices = ['Dry Cleaning', 'Laundry', 'Ironing', 'Stain Removal', 'Alterations'];
        $pressingServiceEntities = [];

        // for ($i = 0; $i < 5; $i++) {
        //     $service = new Service();
        //     $service->setName($faker->word);
        //     $service->setCoeff($faker->randomFloat(2, 0.5, 2.0));

        //     $manager->persist($service);

        // }

        foreach ($pressingServices as $serviceName) {
            $pressingService = new Service();
            $pressingService->setName($serviceName);
            $pressingService->setCoeff($faker->randomFloat(2, 0.5, 2.0));

            $manager->persist($pressingService);
            $pressingServiceEntities[] = $pressingService;
        }
        //status Order
        $statuses = ['Pending', 'Processing', 'Shipped', 'Delivered', 'Cancelled'];
        $statusOrderEntities = [];

        foreach ($statuses as $key => $status) {
            $statusOrder = new Status();
            $statusOrder->setStatus($status);

            $manager->persist($statusOrder);
            $statusOrderEntities[] = $statusOrder;
        }

        for ($i = 0; $i < 10; $i++) {
            $orderProduct = new OrderProduct();
            $orderProduct->setQuantity($faker->numberBetween(1, 10));
            $orderProduct->setProduct($faker->randomElement($productsEntities));
            $orderProduct->setMaterial($faker->randomElement($materialEntities));
            $orderProduct->setQualityProduct($qualityProduct);
            $orderProduct->setStatusOrder($faker->randomElement($statusOrderEntities));
            $orderProduct->setService($faker->randomElement($pressingServiceEntities));
            $orderProduct->setOrderProduct($order);
            $manager->persist($orderProduct);
        }
        $manager->flush();
    }
}

