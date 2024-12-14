<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\Book;
use App\Models\User;
use Spatie\Permission\Traits\HasRoles;

class LoanController extends Controller
{
    use HasRoles;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loans = Loan::with(['user', 'book'])->where('is_archived', false)->get(); // Memuat data loan beserta relasi user dan book
        return view('loans.index', compact('loans'));
    }

    public function userLoans()
    {
        $loans = Loan::with('book')->where('user_id', auth()->id())->where('is_archived', false)->get();
        return view('user.loans', compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $books = Book::all(); // Mendapatkan semua data buku
        $users = User::all(); // Mendapatkan semua data pengguna
        return view('loans.create', compact('books', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'loan_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:loan_date',
            'status' => 'required|in:Dipinjam,Dikembalikan,Terlambat',
        ]);

        Loan::create($validated);

        if (auth()->user()->hasRole('admin')) {
            return redirect()->route('loans.index')->with('success', 'Peminjaman berhasil ditambahkan!');
        } else {
            return redirect()->route('user.loans')->with('success', 'Peminjaman berhasil ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $loan = Loan::with(['user', 'book'])->findOrFail($id);
        return view('loans.show', compact('loan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $loan = Loan::findOrFail($id);
        $books = Book::all();
        $users = User::all();
        return view('loans.edit', compact('loan', 'books', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $loan = Loan::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'loan_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:loan_date',
            'status' => 'required|in:Dipinjam,Dikembalikan,Terlambat',
        ]);

        $loan->update($validated);

        return redirect()->route('loans.index')->with('success', 'Peminjaman berhasil diperbarui!');
    }

    /**
     * Soft delete the specified resource.
     */
    public function destroy(string $id)
    {
        $loan = Loan::findOrFail($id);
        $loan->delete();

        return redirect()->route('loans.index')->with('success', 'Peminjaman berhasil dihapus!');
    }

    /**
     * Show trashed loans.
     */
    public function trashed()
    {
        $loans = Loan::onlyTrashed()->with(['user', 'book'])->get();
        return view('loans.trashed', compact('loans'));
    }

    /**
     * Restore a soft-deleted loan.
     */
    public function restore(string $id)
    {
        $loan = Loan::withTrashed()->findOrFail($id);
        $loan->restore();

        return redirect()->route('loans.index')->with('success', 'Peminjaman berhasil dipulihkan!');
    }

    /**
     * Permanently delete a loan.
     */
    public function forceDelete(string $id)
    {
        $loan = Loan::withTrashed()->findOrFail($id);
        $loan->forceDelete();

        return redirect()->route('loans.index')->with('success', 'Peminjaman berhasil dihapus secara permanen!');
    }

    /**
     * Archive a loan.
     */
    public function archive(string $id)
    {
        $loan = Loan::findOrFail($id);
        $loan->is_archived = true;
        $loan->save();

        return redirect()->route('loans.index')->with('success', 'Peminjaman berhasil diarsipkan!');
    }

    /**
     * Unarchive a loan.
     */
    public function unarchive(string $id)
    {
        $loan = Loan::findOrFail($id);
        $loan->is_archived = false;
        $loan->save();

        return redirect()->route('loans.index')->with('success', 'Peminjaman berhasil dikembalikan dari arsip!');
    }
}
