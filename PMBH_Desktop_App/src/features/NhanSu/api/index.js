import { Platform } from 'react-native';
import httpRequest from '../utils/httpRequest';
import httpRequestAPICCCD from '../utils/httpRequestAPICCCD';
import constants from '../../../api/Api_URL';
import {Instance} from '../../../api/Instance';


export const getPersonnel = async (data?: any): Promise<any[]> => {
  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    {
      table: 'hr_NhanSu',
      func: 'data',
    },
    {},
  );
  return res.data;
};
//Thêm nhân sự
export const addPersonnel = async (data: Record<string, any>): Promise<any> => {
  const payload = {
    table: 'hr_NhanSu',
    func: 'add',
    ...data, // Spread data trực tiếp thay vì nest trong object data
  };
  console.log("Payload gửi lên backend:");
  console.log(JSON.stringify(payload, null, 2));
  
  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};

export const getUserGroup = async (data?: any): Promise<any[]> => {
  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    {
      table: 'lv_lv0004',
      func: 'userGroup',
    },
    {},
  );
  return res.data;
};



// Sửa nhân sự
export const editPersonnel = async (data: Record<string, any>): Promise<any> => {
  const payload = {
    table: 'hr_NhanSu',
    func: 'edit',
    ...data, // Spread data trực tiếp thay vì nest trong object data
  };
  console.log("Payload sửa nhân sự:");
  console.log(JSON.stringify(payload, null, 2));
  
  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;
};

// Xoá nhân sự
export const deletePersonnel = async (lv001: string): Promise<any> => {
  const payload = {
    table: 'hr_NhanSu',
    func: 'delete',
    lv001,
  };
  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    payload,
    {},
  );
  return res.data;

};



const BASE_PARAMS = {
  table: 'hr_NhanSu',
  code: 'admin',
  id: 1,
  token: 'NZ36Ez35vw3nI61N',
};



// Lấy danh sách trạng thái
export const getStatus = async (data?: any): Promise<any[]> => {
  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    {
      table: 'hr_NhanSu',
      func: 'status',
    },
    {},
  );
  return res.data;
};
// Lấy danh sách dân tộc
export const getNation = async (data?: any): Promise<any[]> => {
  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    {
      table: 'hr_NhanSu',
      func: 'nation',
    },
    {},
  );
  return res.data;
};
// Lấy danh sách quốc tịch
export const getNationality = async (data?: any): Promise<any[]> => {
  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    {
      table: 'hr_NhanSu',
      func: 'nationality',
    },
    {},
  );
  return res.data;
};
// Lấy danh sách tôn giáo
export const getReligion = async (data?: any): Promise<any[]> => {
  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    {
      table: 'hr_NhanSu',
      func: 'religion',
    },
    {},
  );
  return res.data;
};
// Lấy danh sách màu da
export const getColor = async (data?: any): Promise<any[]> => {
  const res = await Instance.post<any>(
    constants.API_URLS.SERVICES,
    {
      table: 'hr_NhanSu',
      func: 'color',
    },
    {},
  );
  return res.data;
};



////////////////////////////////////////COMMENT/////////////////////
// Lấy danh sách chủ đề công việc
export const getWorkSubject = async (): Promise<any> => {
  return await httpRequest.post('', {
    ...BASE_PARAMS,
    func: 'workSubject',
  });
};

// Lấy danh sách loại công việc
export const getJobType = async (): Promise<any> => {
  return await httpRequest.post('', {
    ...BASE_PARAMS,
    func: 'jobType',
  });
};

// Lấy danh sách trạng thái tuyển dụng
export const getRecruitmentStatus = async (): Promise<any> => {
  return await httpRequest.post('', {
    ...BASE_PARAMS,
    func: 'recruitmentStatus',
  });
};

// Lấy danh sách phòng ban
export const getDepartment = async (): Promise<any> => {
  return await httpRequest.post('', {
    ...BASE_PARAMS,
    func: 'department',
  });
};

// API xử lý ảnh CCCD
export const ScanCCCD = async (imagePath: string): Promise<any> => {
  const form = new FormData();

  form.append('file', {
    uri: Platform.OS === 'android' ? 'file://' + imagePath : imagePath,
    type: 'image/jpeg',
    name: 'cccd.jpg',
  } as any);

  const response = await httpRequestAPICCCD.post('', form, {
    headers: {
      'Content-Type': 'multipart/form-data',
    },
  });

  return response.data;
};
