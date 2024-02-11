<?php
class Plato
{
    public $name;
    public $price;
    public $category;

    public function __construct($name, $price, $category)
    {
        $this->name = $name;
        $this->price = $price;
        $this->category = $category;
    }

    public function draw($buyable)
    { ?>
        <div class="plato <?php echo $buyable ? 'buyable' : 'non-buyable' ?>">
            <span class="name">
                <?php echo $this->name ?>
            </span>
            <form method="post" class='delete'>
                <input type="hidden" name="name" value="<?php echo $this->name ?>">
                <input type="submit" value="x" name='del'>
            </form>
            <p class="price">
                Precio:
                <?php echo $this->price ?>
            </p>
            <p class="category">
                Categoría:
                <?php echo $this->category ?>
            </p>
            <form method="post" class='quantity'>
                <input type="hidden" name="name" value="<?php echo $this->name ?>">
                <input type="submit" value="-" name='substract'>
                <input type="text" name="cantidad" class="quantity-text"
                    value='<?php echo isset($_SESSION['cart'][$this->name]) ? $_SESSION['cart'][$this->name]['quantity'] : 0; ?>'>
                <input type="submit" value="+" name='add'>
                <input type="submit" value="Guardar" name='mod'>
            </form>
        </div>
    <?php }
}
?>