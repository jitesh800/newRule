<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Promotion Rule</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100">

<div class="max-w-7xl mx-auto p-6">

    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Create Promotion Rule
            </h1>
            <p class="text-slate-500 mt-1">
                Create discounts, offers, and promotional campaigns.
            </p>
        </div>

        <div class="flex gap-3">
            <button class="px-5 py-3 border border-slate-300 rounded-xl bg-white">
                Save Draft
            </button>

            <button class="px-5 py-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700">
                Publish Rule
            </button>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-6">

        <!-- Left Side -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Rule Details -->
            <div class="bg-white rounded-2xl shadow-sm p-6">

                <h2 class="text-lg font-semibold mb-5">
                    Rule Details
                </h2>

                <div class="grid md:grid-cols-2 gap-5">

                    <div>
                        <label class="block text-sm font-medium mb-2">
                            Promotion Name
                        </label>

                        <input
                            type="text"
                            placeholder="Diwali Mega Sale"
                            class="w-full border border-slate-300 rounded-xl px-4 py-3"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2">
                            Status
                        </label>

                        <select class="w-full border border-slate-300 rounded-xl px-4 py-3">
                            <option>Active</option>
                            <option>Inactive</option>
                        </select>
                    </div>

                </div>

                <div class="grid md:grid-cols-2 gap-5 mt-5">

                    <div>
                        <label class="block text-sm font-medium mb-2">
                            Start Date
                        </label>

                        <input
                            type="datetime-local"
                            class="w-full border border-slate-300 rounded-xl px-4 py-3"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2">
                            End Date
                        </label>

                        <input
                            type="datetime-local"
                            class="w-full border border-slate-300 rounded-xl px-4 py-3"
                        >
                    </div>

                </div>

            </div>

            <!-- Templates -->
            <div class="bg-white rounded-2xl shadow-sm p-6">

                <h2 class="text-lg font-semibold mb-5">
                    Quick Templates
                </h2>

                <div class="grid md:grid-cols-3 gap-4">

                    <button class="border rounded-xl p-4 text-left hover:border-indigo-500">
                        <div class="font-semibold">🔥 Cart Discount</div>
                        <div class="text-sm text-slate-500">
                            Order value based discount
                        </div>
                    </button>

                    <button class="border rounded-xl p-4 text-left hover:border-indigo-500">
                        <div class="font-semibold">🎁 Buy X Get Y</div>
                        <div class="text-sm text-slate-500">
                            Purchase reward offer
                        </div>
                    </button>

                    <button class="border rounded-xl p-4 text-left hover:border-indigo-500">
                        <div class="font-semibold">🚚 Free Shipping</div>
                        <div class="text-sm text-slate-500">
                            Shipping promotion
                        </div>
                    </button>

                </div>

            </div>

            <!-- Conditions -->
            <div class="bg-white rounded-2xl shadow-sm p-6">

                <div class="flex items-center justify-between mb-5">
                    <h2 class="text-lg font-semibold">
                        Apply When
                    </h2>

                    <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg">
                        + Add Condition
                    </button>
                </div>

                <div class="space-y-4">

                    <div class="grid grid-cols-12 gap-3">

                        <select class="col-span-4 border rounded-xl px-4 py-3">
                            <option>Product Category</option>
                            <option>Product</option>
                            <option>Brand</option>
                            <option>Order Total</option>
                        </select>

                        <select class="col-span-3 border rounded-xl px-4 py-3">
                            <option>Equals</option>
                            <option>Contains</option>
                            <option>Greater Than</option>
                        </select>

                        <input
                            type="text"
                            placeholder="Electronics"
                            class="col-span-4 border rounded-xl px-4 py-3"
                        >

                        <button class="col-span-1 text-red-500">
                            ✕
                        </button>

                    </div>

                </div>

            </div>

            <!-- Reward -->
            <div class="bg-white rounded-2xl shadow-sm p-6">

                <h2 class="text-lg font-semibold mb-5">
                    Reward
                </h2>

                <div class="grid md:grid-cols-4 gap-4">

                    <label class="border rounded-xl p-4 cursor-pointer">
                        <input type="radio" name="reward" class="mb-2">
                        <div class="font-medium">%</div>
                        <div class="text-sm">Percentage</div>
                    </label>

                    <label class="border rounded-xl p-4 cursor-pointer">
                        <input type="radio" name="reward" class="mb-2">
                        <div class="font-medium">₹</div>
                        <div class="text-sm">Fixed Discount</div>
                    </label>

                    <label class="border rounded-xl p-4 cursor-pointer">
                        <input type="radio" name="reward" class="mb-2">
                        <div class="font-medium">🚚</div>
                        <div class="text-sm">Free Shipping</div>
                    </label>

                    <label class="border rounded-xl p-4 cursor-pointer">
                        <input type="radio" name="reward" class="mb-2">
                        <div class="font-medium">🎁</div>
                        <div class="text-sm">Buy X Get Y</div>
                    </label>

                </div>

                <div class="mt-6">
                    <label class="block text-sm font-medium mb-2">
                        Discount Value
                    </label>

                    <input
                        type="number"
                        placeholder="10"
                        class="w-full border border-slate-300 rounded-xl px-4 py-3"
                    >
                </div>

            </div>

            <!-- Advanced Settings -->
            <div class="bg-white rounded-2xl shadow-sm">

                <details>
                    <summary class="cursor-pointer px-6 py-5 font-semibold">
                        Advanced Settings
                    </summary>

                    <div class="border-t p-6">

                        <div class="grid md:grid-cols-3 gap-5">

                            <div>
                                <label class="block text-sm mb-2">
                                    Priority
                                </label>

                                <select class="w-full border rounded-xl px-4 py-3">
                                    <option>Highest</option>
                                    <option>High</option>
                                    <option selected>Medium</option>
                                    <option>Low</option>
                                    <option>Lowest</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm mb-2">
                                    Usage Limit
                                </label>

                                <input
                                    type="number"
                                    placeholder="100"
                                    class="w-full border rounded-xl px-4 py-3"
                                >
                            </div>

                            <div>
                                <label class="block text-sm mb-2">
                                    Per Customer Limit
                                </label>

                                <input
                                    type="number"
                                    placeholder="1"
                                    class="w-full border rounded-xl px-4 py-3"
                                >
                            </div>

                        </div>

                        <label class="flex items-center gap-3 mt-6">
                            <input type="checkbox">
                            <span>Stop Further Promotions</span>
                        </label>

                    </div>
                </details>

            </div>

        </div>

        <!-- Right Sidebar -->
        <div>

            <div class="sticky top-6">

                <div class="bg-white rounded-2xl shadow-sm p-6">

                    <h2 class="text-lg font-semibold mb-4">
                        Live Preview
                    </h2>

                    <div class="bg-slate-50 rounded-xl p-4">

                        <div class="text-xs uppercase text-slate-500 mb-2">
                            WHEN
                        </div>

                        <p class="text-sm text-slate-700">
                            Product Category = Electronics
                        </p>

                        <hr class="my-4">

                        <div class="text-xs uppercase text-slate-500 mb-2">
                            THEN
                        </div>

                        <p class="text-sm text-slate-700">
                            Apply 10% Discount
                        </p>

                        <hr class="my-4">

                        <div class="text-xs uppercase text-slate-500 mb-2">
                            STATUS
                        </div>

                        <span class="inline-flex px-3 py-1 rounded-full text-sm bg-green-100 text-green-700">
                            Active
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>