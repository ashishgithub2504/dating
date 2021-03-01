<?php
namespace CatalogManager\Model\Entity;

use Cake\ORM\Entity;

use Cake\Routing\Router;
/**
 * Product Entity
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $model
 * @property string $sku
 * @property string $upc
 * @property float $price
 * @property int $quantity
 * @property int $minimum_quantity
 * @property int $stock_status_id
 * @property string $short_description
 * @property string $description
 * @property string $image
 * @property string $meta_title
 * @property string $meta_keyword
 * @property string $meta_description
 * @property bool $status
 * @property int $sort_order
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \CatalogManager\Model\Entity\StockStatus $stock_status
 * @property \CatalogManager\Model\Entity\ProductDiscount[] $product_discounts
 * @property \CatalogManager\Model\Entity\ProductImage[] $product_images
 * @property \CatalogManager\Model\Entity\ProductOption[] $product_options
 * @property \CatalogManager\Model\Entity\ProductSpecial[] $product_specials
 * @property \CatalogManager\Model\Entity\RelatedProduct[] $related_products
 * @property \CatalogManager\Model\Entity\Category[] $categories
 * @property \CatalogManager\Model\Entity\Tag[] $tags
 */
class Product extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_virtual = ['link'];
    protected $_accessible = [
        'title' => true,
        'slug' => true,
        'model' => true,
        'link' => true,
        'sku' => true,
        'upc' => true,
        'price' => true,
        'quantity' => true,
        'minimum_quantity' => true,
        'stock_status_id' => true,
        'short_description' => true,
        'description' => true,
        'image' => true,
        'image_file' => true,
        'meta_title' => true,
        'meta_keyword' => true,
        'meta_description' => true,
        'status' => true,
        'enquirystatus' => true,
        'sort_order' => true,
        'created' => true,
        'modified' => true,
        'stock_status' => true,
        'product_discounts' => true,
        'product_images' => true,
        'product_options' => true,
        'product_specials' => true,
        'related_products' => true,
        'categories' => true,
        'bestselling' => true,
        'is_featured' => true,
        'tags' => true
    ];

    public function _getLink()
    {
        return Router::url('/webroot/img/uploads/products/', true);
    }

    // protected function _getPrice() {
    //     return $this->price;
    // }

    protected function _getTimthumb() {
        return Router::url('/timthumb.php?src=',true);
    }
}
