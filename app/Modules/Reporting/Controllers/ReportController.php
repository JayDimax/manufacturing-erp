<?php

namespace Modules\Reporting\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\Reporting\Services\ReportService;

class ReportController extends Controller
{
    public function __construct(
        protected ReportService $reportService,
    ) {}

    public function index(): View
    {
        return view('admin.reports.index');
    }

    public function procurement(Request $request): View
    {
        $filters = $request->only(['date_from', 'date_to', 'status']);
        $data = $this->reportService->procurementSummary($filters);

        return view('admin.reports.procurement.index', $data);
    }

    public function inventory(Request $request): View
    {
        $filters = $request->only(['date_from', 'date_to', 'product_id']);
        $data = $this->reportService->inventorySummary($filters);

        return view('admin.reports.inventory.index', $data);
    }

    public function manufacturing(Request $request): View
    {
        $filters = $request->only(['date_from', 'date_to', 'status']);
        $data = $this->reportService->manufacturingSummary($filters);

        return view('admin.reports.manufacturing.index', $data);
    }

    public function quality(Request $request): View
    {
        $filters = $request->only(['date_from', 'date_to', 'status']);
        $data = $this->reportService->qualitySummary($filters);

        return view('admin.reports.quality.index', $data);
    }

    public function warehouse(Request $request): View
    {
        $filters = $request->only(['date_from', 'date_to']);
        $data = $this->reportService->warehouseSummary($filters);

        return view('admin.reports.warehouse.index', $data);
    }

    public function sales(Request $request): View
    {
        $filters = $request->only(['date_from', 'date_to', 'status']);
        $data = $this->reportService->salesSummary($filters);

        return view('admin.reports.sales.index', $data);
    }

    public function accounting(Request $request): View
    {
        $filters = $request->only(['date_from', 'date_to']);
        $data = $this->reportService->accountingSummary($filters);

        return view('admin.reports.accounting.index', $data);
    }

    public function executive(): View
    {
        $data = $this->reportService->executiveSummary();

        return view('admin.reports.executive.index', $data);
    }

    public function procurementReport(Request $request): View
    {
        return $this->procurement($request);
    }

    public function exportProcurementReport(Request $request)
    {
        $filters = $request->only(['date_from', 'date_to', 'status']);
        $data = $this->reportService->procurementSummary($filters);

        return response()->json($data);
    }

    public function inventoryReport(Request $request): View
    {
        return $this->inventory($request);
    }

    public function exportInventoryReport(Request $request)
    {
        $filters = $request->only(['date_from', 'date_to', 'product_id']);
        $data = $this->reportService->inventorySummary($filters);

        return response()->json($data);
    }

    public function manufacturingReport(Request $request): View
    {
        return $this->manufacturing($request);
    }

    public function exportManufacturingReport(Request $request)
    {
        $filters = $request->only(['date_from', 'date_to', 'status']);
        $data = $this->reportService->manufacturingSummary($filters);

        return response()->json($data);
    }

    public function qualityReport(Request $request): View
    {
        return $this->quality($request);
    }

    public function exportQualityReport(Request $request)
    {
        $filters = $request->only(['date_from', 'date_to', 'status']);
        $data = $this->reportService->qualitySummary($filters);

        return response()->json($data);
    }

    public function warehouseReport(Request $request): View
    {
        return $this->warehouse($request);
    }

    public function exportWarehouseReport(Request $request)
    {
        $filters = $request->only(['date_from', 'date_to']);
        $data = $this->reportService->warehouseSummary($filters);

        return response()->json($data);
    }

    public function salesReport(Request $request): View
    {
        return $this->sales($request);
    }

    public function exportSalesReport(Request $request)
    {
        $filters = $request->only(['date_from', 'date_to', 'status']);
        $data = $this->reportService->salesSummary($filters);

        return response()->json($data);
    }

    public function accountingReport(Request $request): View
    {
        return $this->accounting($request);
    }

    public function exportAccountingReport(Request $request)
    {
        $filters = $request->only(['date_from', 'date_to']);
        $data = $this->reportService->accountingSummary($filters);

        return response()->json($data);
    }
}
