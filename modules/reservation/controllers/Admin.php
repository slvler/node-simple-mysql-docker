<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
		// Yönetim paneli kullanıcı girişi kontrolü
		if (! isset($this->session->userdata['logged_in'])) { redirect('/admin/login', 'refresh'); }
		
		$this->load->model('reservation/Admin_model');
		$this->load->helper('img_upload');
	}
	
	public function index()
	{
		$this->load->library('migration');
		if ($this->migration->init_module("reservation")) { $this->migration->current(); }
		
		$this->load->library('pagination');
		
		//Filtreleme
		if($this->input->get('start_date') || $this->input->get('register_start_date')) {
			$this->data['page'] = (array) $this->Admin_model->record_filter($this->input->get(), 25);
		} else {
			$pagination['page_query_string']	= TRUE;
			$pagination['base_url']				= "reservation/admin/index";
			$pagination['total_rows']			= $this->Admin_model->recCount();
			$pagination['per_page']				= 25;
			$pagination['full_tag_open']		= '<div class="btn-group pull-right mt-15">';
			$pagination['full_tag_close']		= '</div>';
			$pagination['first_link']			= 'İlk';
			$pagination['cur_tag_open']			= '<a class="btn btn-xs btn-success">';
			$pagination['cur_tag_close']		= '</a>';
			$pagination['last_link']			= 'Son';
			$pagination['attributes']			= array('class' => 'btn btn-xs btn-success btn-outline');
			$this->pagination->initialize($pagination);

			if(@$_GET["s"]){
				$this->data['page'] = (array) $this->Admin_model->search(trim($_GET["s"]));
			}else{
				$this->data['page'] = (array) $this->Admin_model->page($pagination["per_page"], intval(@$_GET["per_page"]));
			}
	
			if(@$_GET["status"]){
				$this->data['page'] = (array) $this->Admin_model->page($pagination["per_page"], intval(@$_GET["per_page"]),$_GET['status']);
			}
		}
		

		$this->data['total_count'] = $this->Admin_model->recCount();
		$this->load->view('reservation/admin/admin', $this->data);
	}

	public function add_record()
	{
		if($_POST){
			$this->Admin_model->add_record($this->input->post());
			$this->session->set_flashdata("success_message", "Kayıt işlemi başarılı!");
			redirect('/reservation/admin/index/', 'refresh');
		}else{
			$this->load->view('reservation/admin/add_record');
		}
	}

	public function edit_record()
	{
		if($_POST){
			$id = (int)($this->uri->segment(4));
			$this->Admin_model->edit_record($id,$this->input->post());			
			$this->session->set_flashdata("success_message", "Düzenleme başarılı!");
			redirect('reservation/admin/edit_record/'.$id, 'refresh');
		}else{
			$id = (int)($this->uri->segment(4));
			$this->data['page'] = (array) $this->Admin_model->record($id);			
			$this->load->view('reservation/admin/edit_record', $this->data);
		}
	}
	
	public function record()
	{
		$id = (int)($this->uri->segment(4));
		$this->data['record'] = (array) $this->Admin_model->record($id);
		print_r(voucher_panel($this->data['record']));exit;
	}

	public function voucher_print()
	{
		$id = (int)($this->uri->segment(4));
		$this->data['record'] = (array) $this->Admin_model->record($id);
		print_r(voucher_print($this->data['record']));exit;
	}

	public function voucher()
	{
		$id = (int)($this->uri->segment(4));
		$record = (array) $this->Admin_model->record($id);
		$voucher = voucher_panel($record);
		// Sigortanın seçilebilir ve seçilemez durumuna göre iptal politikası içeriği değişiyor.
		$this->load->helper('content/content');
		if ($record['total_insurance']>0) {
			$cancellation = get_content_admin(get_lang_id_record(66,'content',$record["language"])->id);
		}else{
			$cancellation = get_content_admin(get_lang_id_record(239,'content',$record["language"])->id);
		}
		// Mesafeli satış sözleşmesi de voucherda gönderilmek üzere çekiliyor.
		$sales_contract = get_content_admin(get_lang_id_record(67,'content',$record["language"])->id);
		$send_mail_voucher = $this->Admin_model->send_mail_voucher($voucher,$record['email'],$cancellation,$sales_contract,$record['reserve_no']);
		$this->session->set_flashdata("success_message", "Voucher başarılı bir şekilde gönderildi!");
		redirect('/reservation/admin/index', 'refresh');
		
	}

	public function delete_record()
	{
		$id = (int)($this->uri->segment(4));
		
		$this->Admin_model->delete_record($id);
		$this->session->set_flashdata("success_message", "Silme işlemi başarılı!");
		redirect('/reservation/admin/index', 'refresh');
	}
	
	public function excel_export()
	{
		if(! file_exists("_cache")){ mkdir("_cache", 0777); }
		if(! file_exists("_cache/excel_export")){ mkdir("_cache/excel_export", 0777); }
		$this->load->library('Excel');
		$excel_export = new PHPExcel();
		
		$excel_export->getActiveSheet()->setTitle(date("d-m-Y"));
		
		$excel_export->getActiveSheet()->setCellValue('A1', 'Ad');
		$excel_export->getActiveSheet()->setCellValue('B1', 'Soyad');
		$excel_export->getActiveSheet()->setCellValue('C1', 'E-Posta');
		$excel_export->getActiveSheet()->setCellValue('D1', 'Telefon');
		$excel_export->getActiveSheet()->setCellValue('E1', 'Şehir');
		$excel_export->getActiveSheet()->setCellValue('F1', 'İlçe');
		$excel_export->getActiveSheet()->setCellValue('G1', 'Adres');
		$excel_export->getActiveSheet()->setCellValue('H1', 'Üyelik Tarihi');
		$excel_export->getActiveSheet()->setCellValue('I1', 'Üyelik Durumu');
		
		$row = 2;
		foreach($this->Admin_model->page() as $member){
			$active = ($member->active == 1 ? "Aktif" : "Pasif");
			
			$excel_export->getActiveSheet()->setCellValue("A".$row, $member->name);
			$excel_export->getActiveSheet()->setCellValue("B".$row, $member->surname);
			$excel_export->getActiveSheet()->setCellValue("C".$row, $member->email);
			$excel_export->getActiveSheet()->setCellValue("D".$row, $member->phone);
			$excel_export->getActiveSheet()->setCellValue("E".$row, get_city_title($member->city));
			$excel_export->getActiveSheet()->setCellValue("F".$row, get_town_title($member->town));
			$excel_export->getActiveSheet()->setCellValue("G".$row, $member->address);
			$excel_export->getActiveSheet()->setCellValue("H".$row, $member->created_date);
			$excel_export->getActiveSheet()->setCellValue("I".$row, $active);
			$row++;
		}
		
		$dateid = date('YmdHis');
		$save = PHPExcel_IOFactory::createWriter($excel_export, 'Excel5');
		$save->save("_cache/excel_export/uyeler-".$dateid.".xls");
		$this->load->helper('download');
		force_download("_cache/excel_export/uyeler-".$dateid.".xls", NULL);
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function excel_export2()
	{
		$records = (array) $this->Admin_model->record_filter($this->input->get(), 0);
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		$sheet = $this->excel->getActiveSheet();
		$sheet->setTitle('Denizatı');
		
		$sheet->setCellValue('A1', 'Rezervasyon No');
		$sheet->setCellValue('B1', 'Ad Soyad');
		$sheet->setCellValue('C1', 'Giriş Tarihi');
		$sheet->setCellValue('D1', 'Çıkış Tarihi');
		$sheet->setCellValue('E1', 'Rezervasyon Tarihi');
		$sheet->setCellValue('F1', 'Ara Toplam');
		$sheet->setCellValue('G1', 'Sigorta');
		$sheet->setCellValue('H1', 'Toplam');
		$sheet->setCellValue('I1', 'Ödeme Tipi');
		$sheet->setCellValue('J1', 'Ödenen Tutar');
		$sheet->setCellValue('K1', 'Otelde Ödenecek Tutar');
		$sheet->setCellValue('L1', 'Telefon');
		$sheet->setCellValue('M1', 'Durum');
		$sheet->getStyle("A1:M1")->getFont()->setBold( true );
		
		$row = 2;
		foreach($records as $reservation){
			$start_date = $reservation->start_date;
			$end_date = $reservation->end_date;
			$tr_months = array("Ocak","Şubat","Mart","Nisan","Mayıs","Haziran","Temmuz","Ağustos","Eylül","Ekim","Kasım","Aralık");
			$start_date = explode("-", $start_date);
			$end_date = explode("-", $end_date);
			$start_date = $start_date[2]." ".$tr_months[$start_date[1]-1]." ".$start_date[0];
			$end_date = $end_date[2]." ".$tr_months[$end_date[1]-1]." ".$end_date[0];
			$deposit_total = str_replace(",", "", $reservation->total_price) - str_replace(",", "", $reservation->pay_price);
			
			$sheet->setCellValue("A".$row, $reservation->reserve_no);
			$sheet->setCellValue("B".$row, $reservation->name.' '.$reservation->surname);
			$sheet->setCellValue("C".$row, $start_date);
			$sheet->setCellValue("D".$row, $end_date);
			$sheet->setCellValue("E".$row, $reservation->created_date);
			if($reservation->total_amount) {
				$sheet->setCellValue("F".$row, $reservation->total_amount.' '.$reservation->currency);
			}
			if($reservation->total_insurance) {
				$sheet->setCellValue("G".$row, $reservation->total_insurance.' '.$reservation->currency);
			}
			$sheet->setCellValue("H".$row, $reservation->total_price.' '.$reservation->currency);
			$sheet->setCellValue("I".$row, $reservation->pay_hotel);
			$sheet->setCellValue("J".$row, $reservation->pay_price.' '.$reservation->currency);
			$sheet->setCellValue("K".$row, number_format($deposit_total,2).' '.$reservation->currency);
			$sheet->setCellValue("L".$row, $reservation->phone);
			$sheet->setCellValue("M".$row, $reservation->status);
			$row++;
		}
		

		$filename='denizati.xls';
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		$objWriter->save('php://output');
	}
}