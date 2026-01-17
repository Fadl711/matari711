@if (Auth::user()->usertype=='admin')




<div class=" ">
    <table class=" min-w-full rounded-xl ">
        <thead>
            <tr class="bg-gray-50">
                <th scope="col" class="  text-center text-sm leading-2  text-gray-900 capitalize rounded-t-xl">  id </th>

                <th scope="col" class="  text-center text-sm leading-2  text-gray-900 capitalize rounded-t-xl"> اسم المستخدم </th>

                <th scope="col" class="  text-center text-sm leading-2  text-gray-900 capitalize rounded-t-xl"> الإميل  </th>
                <th scope="col" class="  text-center text-sm leading-2  text-gray-900 capitalize">صلاحية النشر</th>



            </tr>
        </thead>
        @forelse ($users as $user)
        @if($user->usertype=="admin")
        @continue
        @endif
                      <tbody class="divide-y divide-gray-300 ">
                          <tr class="bg-white transition-all duration-500 ">



                            <td class="p-1 whitespace-nowrap text-sm text-center   text-gray-900 "> {{$loop->iteration}}</td>
                            <td class="p-1 whitespace-nowrap text-sm text-center  text-gray-900 "> {{ $user->name}}</td>

                              <td class="p-1 whitespace-nowrap text-sm text-center  text-gray-900 ">{{ $user->email}}</td>
                              <td class="p-1 whitespace-nowrap text-sm text-center  text-gray-900 ">
                                <form action="{{route('user.edit',$user->id)}} " method="POST" class=" relative">
                                    @csrf
                                    <select name="usertype" class="mt-4 bg-gray-50 border   border-gray-300 text-gray-900 text-sm rounded-e-lg border-s-gray-100 dark:border-s-gray-700 border-s-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option  value="user">مستخدم</option>
                                    <option @if ($user->usertype=='admin2')
                                selected
                                    @endif value="admin2">مشرف</option>

                                </select>

                                    <button class=" absolute left-0  bottom-12 bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 md:px-4  md:py-2 rounded">
                                    تغير الصلاحية
                                  </button>

                                </form>
                              </td>


                          </tr>
                          @empty


                          <tr>
                            <td>not fuond</td>
                          </tr>

                        </tbody>
                    </table>
                </div>

            </div>
            @endforelse



@endif
