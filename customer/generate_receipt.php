
<?php
require('../fpdf/fpdf.php');
include("../includes/db.php");

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];



    // Fetch order details
    $get_order = "SELECT * FROM customer_order WHERE order_id='$order_id'";
    $run_order = mysqli_query($con, $get_order);
    $row_order = mysqli_fetch_array($run_order);

    $invoice_no = $row_order['invoice_no'];
    $due_amount = $row_order['due_amount'];
    $order_date = $row_order['order_date'];
    $amount_paid = $row_order['amount_paid'];
    $total_amount = $row_order['total_amount'];

    // Fetch customer details
    $customer_id = $row_order['customer_id'];
    $get_customer = "SELECT * FROM customers WHERE customer_id='$customer_id'";
    $run_customer = mysqli_query($con, $get_customer);
    $row_customer = mysqli_fetch_array($run_customer);
    $customer_name = $row_customer['customer_name'];
    $customer_email = $row_customer['customer_email'];
    $customer_address = $row_customer['customer_address'];

    // Create PDF
    $pdf = new FPDF('P', 'mm', array(90, 197)); // Cash memo size
    $pdf->AddPage();

    // Add header
    $pdf->SetFont('Arial', 'B', 15);
   
    $pdf->Cell(0, 5, 'AroInsa Medicine Solution', 0, 1, 'C');
    $pdf->Ln(2);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 5, 'www.AroInsamedicine.com', 0, 1, 'C');
    $pdf->Cell(0, 5, 'Tel: +880 1558-711356', 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(0, 5, 'Order Date: ' . $order_date, 0, 1, 'C');

    // Add dotted line
    $pdf->Ln(4);
    $pdf->Cell(0, 0, '', 1, 1, 'C', false, '.....');

    // Add invoice number
    $pdf->Ln(2);
    $pdf->SetFont('Arial', 'B');
    $pdf->Cell(0, 5, 'Invoice No: ' . $invoice_no, 0, 1, 'L');

    // Add dotted line
    $pdf->Ln(2);
    $pdf->Cell(0, 0, '', 1, 1, 'C', false, '.....');

    // Add customer details with labels on left and values on right
    $pdf->Ln(4);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(40, 5, 'Customer Name:', 0, 0, 'L');
    $pdf->Cell(40, 5, $customer_name, 0, 1, 'C');
    $pdf->Cell(40, 5, 'Customer Email:', 0, 0, 'L');
    $pdf->Cell(40, 5, $customer_email, 0, 1, 'C');
    $pdf->Cell(40, 5, 'Customer Address:', 0, 0, 'L');
    $pdf->Cell(40, 5, $customer_address, 0, 1, 'C');

    // Add dotted line
    $pdf->Ln(2);
    $pdf->Cell(0, 0, '', 1, 1, 'C', false, '.....');

    // Add product table header with smaller font size
    $pdf->Ln(3);
    $pdf->SetFont('Arial', 'B', 8.5);
    $pdf->Cell(32, 5, 'Product Name', 0, 0, 'L');
    $pdf->Cell(16, 5, 'Unit Price', 0, 0, 'L');
    $pdf->Cell(12, 5, 'Qty', 0, 0, 'L');
    $pdf->Cell(20, 5, 'Total', 0, 1, 'L');

    // Add product details
    $get_products = "SELECT products.product_title, customer_order.qty, products.product_price
                     FROM customer_order
                     INNER JOIN products ON customer_order.product_id = products.product_id
                     WHERE customer_order.order_id='$order_id'";
    $run_products = mysqli_query($con, $get_products);

    $pdf->SetFont('Arial', '', 8.5);
    while ($row_product = mysqli_fetch_array($run_products)) {
        $product_title = $row_product['product_title'];
        $qty = $row_product['qty'];
        $unit_price = $row_product['product_price'];
        $total_price = $qty * $unit_price;

        $pdf->Cell(32, 5, $product_title, 0, 0, 'L');
        $pdf->Cell(16, 5, $unit_price, 0, 0, 'L');
        $pdf->Cell(12, 5, $qty, 0, 0, 'L');
        $pdf->Cell(20, 5, $total_price, 0, 1, 'L');
    }

    // Add dotted line
    $pdf->Ln(2);
    $pdf->Cell(0, 0, '', 1, 1, 'C', false, '.....');

    // Add total amount paid and due amount
    $pdf->Ln(2);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, 'Total Amount Paid: ' . $amount_paid . ' tk', 0, 1, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 10, 'Due Amount: ' . $due_amount . ' tk', 0, 1, 'L');

    
  // Add dotted line
  $pdf->SetFont('Arial', 'B',8 );
  $pdf->Ln(2);
  $dotted_line = str_repeat('.', 50);
  $pdf->Cell(0, 0, $dotted_line, 0, 1, 'C');
    // Add image and thank you message with increased space below
    $pdf->Ln(1);
    $pdf->Image('../image/qrcode.png', 15, $pdf->GetY(), 60); // Adjust the path and size as needed
    $pdf->Ln(60); // Increase the value to place the text below the image
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(0, 10, 'Thank you! Glad to see you again!', 0, 1, 'C');

    $pdf->Output();




// Send headers to download the PDF file
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="invoice.pdf"');

// Output the PDF file
echo $pdf_output;

}

?>











