<?php
declare(strict_types=1);
/*
 * This file is part of the bileMo project.
 *
 * (c) Laurent BERTON <lolosambo2@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\Domain\DataFixtures\ORM;

use App\Domain\Models\Products;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
/**
 * Class ProductsFixtures
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class ProductsFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     *
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 50; $i++) {
            $productName = 'Product'.$i;
            $brand = array_rand(['Samsung', 'Sony', 'Apple', 'LG', 'Huawei'], 1);
            $description = 'Tu autem, Fanni, quod mihi tantum tribui dicis quantum ego nec adgnosco nec postulo, 
            facis amice; sed, ut mihi videris, non recte iudicas de Catone; aut enim nemo, quod quidem magis credo, 
            aut si quisquam, ille sapiens fuit. Quo modo, ut alia omittam, mortem filii tulit! memineram Paulum, 
            videram Galum, sed hi in pueris, Cato in perfecto et spectato viro.
            Accedebant enim eius asperitati, ubi inminuta vel laesa amplitudo imperii dicebatur, et iracundae suspicionum 
            quantitati proximorum cruentae blanditiae exaggerantium incidentia et dolere inpendio simulantium, si 
            principis periclitetur vita, a cuius salute velut filo pendere statum orbis terrarum fictis vocibus exclamabant.
            Adolescebat autem obstinatum propositum erga haec et similia multa scrutanda, 
            stimulos admovente regina, quae abrupte mariti fortunas trudebat in exitium praeceps, 
            cum eum potius lenitate feminea ad veritatis humanitatisque viam reducere utilia suadendo deberet, 
            ut in Gordianorum actibus factitasse Maximini truculenti illius imperatoris rettulimus coniugem.';
            $price = mt_rand(500, 1000);

            $product = new Products($productName, $brand, $description, $price);

            $product->setWeight(mt_rand(200, 300));
            $product->setHeight(mt_rand(90, 150));
            $product->setWidth(mt_rand(50, 80));
            $product->setScreen(array_rand(['5 pouces', '7 pouces', '9 pouces', '10.5 pouces'], 1));
            $product->setOs(array_rand(['Androïd Lollipop', 'IOS 10', 'Windows Phone'], 1));

            $this->addReference('product'.$i, $product );
            $manager->persist($product);
        }
        $manager->flush();
    }
}