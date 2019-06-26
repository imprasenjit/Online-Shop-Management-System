<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Shopping extends CI_Controller
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('cart');
        $this->load->model('billing_model');
        $this->load->model('products_model');
        $this->load->helper('string');
        $this->load->helper('form');
    }
    /**
     * add
     *
     * @return void
     */
    public function add()
    {
        $pid = $this->input->post('id');
        $quantity = $this->input->post('qty');
        $product_unit = $this->input->post('product_unit');
        $attributes = $this->input->post('attributes');
        $attr_names = $this->input->post('attr_names');
        $others = $this->input->post('others');
        $result = $this->products_model->get_by_id($pid);
        $insert_data = array(
            'id' => uniqid(),
            'product_id' => $pid,
            'name' => $result->product_name,
            'price' => 0,
            'qty' => $quantity,
            'quantity' => $quantity,
            'product_unit' => $product_unit,
            'attributes' => $attributes,
            'attr_names' => $attr_names,
            'others' => $others,
        );
        $this->cart->insert($insert_data);
        ?>
    <table class="table table-hover">
        <?php
        if ($cart = $this->cart->contents()) { ?>
            <thead>
                <tr id="main_heading">
                    <th>Sl No.</th>
                    <th>Name</th>
                    <th>Qty</th>
                    <th>UOM</th>
                    <th>Attributes</th>
                    <th>Others</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <?php $i = 1;
            foreach ($cart as $item) { ?>
                <tr>
                    <td>
                        <?php echo $i++; ?>
                    </td>
                    <td>
                        <?php echo $item['name']; ?>
                    </td>
                    <td>
                        <?php echo $item['quantity']; ?>
                    </td>
                    <td>
                        <?php echo $item['product_unit']; ?>
                    </td>
                    <td>
                        <?php
                        $attr_names = $item["attributes"];
                        foreach ($item["attr_names"] as $key => $values) {
                            echo $attr_names[$key] . ' : ' . $values . "<br>";
                        }
                        ?>
                    </td>
                    <td>
                        <?php echo $item['others']; ?>
                    </td>
                    <td align="center">
                        <a href="<?= base_url(); ?>shopping/remove/<?= $item['rowid'] ?>" ]>
                            <font color="red"><i class="fa fa-times fa-2x" aria-hidden="true"></i></font>
                        </a>
                    </td>
                <?php } ?>
            </tr>
        <?php } ?>
    </table>
<?php }
/**
 * remove
 *
 * @param mixed $rowid
 * @return void
 */
public function remove($rowid)
{
    if ($rowid === "all") {
        $this->cart->destroy();
    } else {
        $data = array(
            'rowid' => $rowid,
            'qty' => 0,
        );
        $this->cart->update($data);
    }
    redirect(base_url() . 'shopping/billing');
}
/**
 * update_cart
 *
 * @return void
 */
public function update_cart()
{
    $cart_info = $_POST['cart'];
    foreach ($cart_info as $id => $cart) {
        $rowid = $cart['rowid'];
        $price = $cart['price'];
        $amount = $price * $cart['qty'];
        $qty = $cart[$this->input->post('qty')];
        //$qty = $cart['qty'];
        $data = array(
            'rowid' => $rowid,
            'price' => $price,
            'amount' => $amount,
            'qty' => $qty,
        );
        $this->cart->update($data);
    }
    redirect(base_url("shopping/billing"));
}
/**
 * edit
 *
 * @return void
 */
public function edit()
{
    $data = $this->cart->update(array(
        'rowid' => $this->input->post('rowid', TRUE),
        'qty' => $this->input->post('qty', TRUE),
    ));
    $this->cart->update($data);
    echo json_encode(true);
}
/**
 * billing
 *
 * @return void
 */
public function billing()
{
    $this->load->view('site/requires/header', array('page' => 'Enquiry'));
    $this->load->view('site/shopping/billing_view');
    $this->load->view('site/requires/footer');
}
/**
 * save_order
 *
 * @return void
 */
public function save_order()
{
    $this->load->model("customers_model");
    if ($cart = $this->cart->contents()) {
        if ($this->session->userdata("id")) {
            $customer_details = $this->customers_model->get_by_id($this->session->userdata("id"));
            $customer = array(
                'enquiry_placed_date' => date('Y-m-d H:i:s'),
                'customerid' => $customer_details->id,
                'name' => $customer_details->name,
                'email' => $customer_details->email,
                'address' => $customer_details->address,
                'state' => $this->input->post("state", TRUE),
                'contact' => $customer_details->contact,
            );
        }
        $ord_id = $this->billing_model->insert_enquiry($customer);
        $enq_ref = genunqid(0, $ord_id);
        $this->billing_model->update_enquiry($ord_id, array("enq_ref" => $enq_ref));
        foreach ($cart as $item) {
            $attributes_array = [];
            for ($i = 1; $i < (count($item["attributes"]) + 1); $i++) {
                $attributes_array["attr" . $i][] = $item["attributes"][$i - 1];
                $attributes_array["attr" . $i][] = $item["attr_names"][$i - 1];
            }
            $attributes_array = json_encode(array("attributes" => $attributes_array));
            $order_detail = array(
                'enquiry_id' => $ord_id,
                'productid' => $item['product_id'],
                'quantity' => $item['qty'],
                'product_unit' => $item['product_unit'],
                'others' => $item['others'],
                'attributes' => $attributes_array,
            );
            $cust_id = $this->billing_model->insert_order_detail($order_detail);
        }
        $this->cart->destroy();
        redirect(base_url("shopping/billing_success"));
    } else {
        $this->session->set_flashdata('message', 'Please select the products. You dont have product in cart');
        redirect(base_url("shopping/billing"));
    }
}
/**
 * billing_success
 *
 * @return void
 */
public function billing_success()
{
    $this->load->view('site/requires/header', array('page' => 'Success'));
    $this->load->view('site/shopping/billing_success');
    $this->load->view('site/requires/footer');
}
}
?>