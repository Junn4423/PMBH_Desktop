import React from 'react';
import { Space, Button } from 'antd';
import { Plus, RotateCcw, FileText, Upload } from 'lucide-react';
import './HeaderOption.css';

const HeaderOption = ({ onAdd, onReload, onReport, onExport }) => {
  return (
    <div className="header-option-container">
      <Space size="middle" className="header-option-buttons">
        <Button 
          type="primary" 
          icon={<Plus size={16} />} 
          onClick={onAdd}
          className="header-option-button add-button"
        >
          Thêm
        </Button>
        <Button 
          icon={<RotateCcw size={16} />} 
          onClick={onReload}
          className="header-option-button reload-button"
        >
          Tải lại
        </Button>

        <Button 
          icon={<FileText size={16} />} 
          onClick={onReport}
          className="header-option-button report-button"
        >
          Báo cáo
        </Button>

        <Button 
          icon={<Upload size={16} />} 
          onClick={onExport}
          className="header-option-button export-button"
        >
          Xuất
        </Button>
      </Space>
    </div>
  );
};

export default HeaderOption;
  },
  export: {
    backgroundColor: '#dc3545',
  },
});

export default HeaderOption;
