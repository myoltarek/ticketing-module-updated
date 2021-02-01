<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Crm;
use App\Models\Ticket;
use Illuminate\Http\Request;

class GetChartDataController extends Controller
{

    function getAllMonthsTickets(){

		$month_array = array();
		$tickets_dates = Ticket::select('created_at')->orderBy( 'created_at', 'ASC' )->get();
		$tickets_dates = json_decode( $tickets_dates );

		if ( ! empty( $tickets_dates ) ) {
			foreach ( $tickets_dates as $unformatted_date ) {
				$date = new \DateTime( $unformatted_date->created_at );
				$month_no = $date->format( 'm' );
				$month_name = $date->format( 'M' );
				$month_array[ $month_no ] = $month_name;
			}
		}
		return $month_array;
	}

	function getMonthlyTicketCount( $month ) {
		$monthly_ticket_count = Ticket::whereMonth( 'created_at', $month )->get()->count();
		return $monthly_ticket_count;
	}

	function getMonthlyTicketData() {

		$monthly_ticket_count_array = array();
		$month_array = $this->getAllMonthsTickets();
		$month_name_array = array();
		if ( ! empty( $month_array ) ) {
			foreach ( $month_array as $month_no => $month_name ){
				$monthly_ticket_count = $this->getMonthlyTicketCount( $month_no );
				array_push( $monthly_ticket_count_array, $monthly_ticket_count );
				array_push( $month_name_array, $month_name );
			}
		}

		$max_no = max( $monthly_ticket_count_array );
		$max = round(( $max_no + 10/2 ) / 10 ) * 10;
		$monthly_ticket_data_array = array(
			'months' => $month_name_array,
			'ticket_count_data' => $monthly_ticket_count_array,
			'max' => $max,
		);

		return $monthly_ticket_data_array;

    }

    function getAllMonthsCrms(){

		$month_array = array();
		$crms_dates = Crm::select('created_at')->orderBy( 'created_at', 'ASC' )->get();
		$crms_dates = json_decode( $crms_dates );

		if ( ! empty( $crms_dates ) ) {
			foreach ( $crms_dates as $unformatted_date ) {
				$date = new \DateTime( $unformatted_date->created_at );
				$month_no = $date->format( 'm' );
				$month_name = $date->format( 'M' );
				$month_array[ $month_no ] = $month_name;
			}
		}
		return $month_array;
	}

	function getMonthlyCrmCount( $month ) {
		$monthly_crm_count = Crm::whereMonth( 'created_at', $month )->get()->count();
		return $monthly_crm_count;
	}

	function getMonthlyCrmData() {

		$monthly_crm_count_array = array();
		$month_array = $this->getAllMonthsCrms();
		$month_name_array = array();
		if ( ! empty( $month_array ) ) {
			foreach ( $month_array as $month_no => $month_name ){
				$monthly_crm_count = $this->getMonthlyCrmCount( $month_no );
				array_push( $monthly_crm_count_array, $monthly_crm_count );
				array_push( $month_name_array, $month_name );
			}
		}

		$max_no = max( $monthly_crm_count_array );
		$max = round(( $max_no + 10/2 ) / 10 ) * 10;
		$monthly_crm_data_array = array(
			'months' => $month_name_array,
			'crm_count_data' => $monthly_crm_count_array,
			'max' => $max,
		);

		return $monthly_crm_data_array;

    }


}
