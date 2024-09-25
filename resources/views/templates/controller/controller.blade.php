

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\{{ ucfirst($name) }}\I{{ ucfirst($name) }}Service;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Create{{ ucfirst($name) }}Request;
use App\Http\Requests\Update{{ ucfirst($name) }}Request;
use Exception;

class {{ ucfirst($name) }}Controller extends Controller
{

    public function __construct(private I{{ ucfirst($name) }}Service ${{ lcfirst($name) }}Service)
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
     public function index(): View
    {
        $data = $this->{{ lcfirst($name) }}Service->findAll();
        return view('admin.{{ lcfirst($name) }}.index')->with([
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.{{ lcfirst($name) }}.create')->with([]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param {{ ucfirst($name) }}Request $request
     * @return RedirectResponse
     */
    public function store(Create{{ ucfirst($name) }}Request $request): RedirectResponse
    {
        try {
            $response = $this->{{ lcfirst($name) }}Service->create($request->all());

            if ($response) {
                return redirect()->back()->with('success', '{{ ucfirst($name) }} added successfully.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }

        return redirect()->back()->with('error', 'Something went wrong. Please try again.');
    }

    /**
     * Display the specified resource.
     *
     * @param string $id
     * @return View
     */
    public function show(string $id) // : View
    {
        // You can add logic to fetch and return data for the specific resource here.
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $id
     * @return View
     */
    public function edit(string $id): View
    {
        try {
            $response = $this->{{ lcfirst($name) }}Service->findById($id);

            return view('admin.{{ lcfirst($name) }}.edit')->with([
                'data' => $response,
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error retrieving the resource.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Update{{ ucfirst($name) }}Request $request
     * @param string $id
     * @return RedirectResponse
     */
    public function update(Update{{ ucfirst($name) }}Request $request, string $id): RedirectResponse
    {
        try {
            $this->{{ lcfirst($name) }}Service->update($request->all());

            return redirect()->back()->with('success', '{{ ucfirst($name) }} updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong while updating.');
        }
    }

    /**
    * Deletes a {{ ucfirst($name) }} by its ID.
    *
    * @param string $id The ID of the {{ ucfirst($name) }} to be deleted.
    * @return \Illuminate\Http\RedirectResponse Redirects back with a success or error message.
    * @throws \Exception If something goes wrong during the deletion process.
    */
    public function destroy(string $id): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $this->projectService->deleteById($id);
            DB::commit();

            return redirect()->back()->with('success', '{{ ucfirst($name) }} deleted successfully.');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Something went wrong while deleting: ' . $e->getMessage());
        }
    }
}
