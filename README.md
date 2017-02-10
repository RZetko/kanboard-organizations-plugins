Kanboard Plugin to add organizations to tasks
==========================

This plugin adds organizations to projects which are assignable to tasks. Organizations are shown on board.

Plugin for https://github.com/fguillot/kanboard


Installation
------------

- Decompress the archive
- Copy 'plugins' folder to kanboard root folder
- Replace app/Model/TaskCreationModel.php in kanboard root with our TaskCreationModel.php (added event hook after saving item)

Usage
-----

- Navigate to project settings
- Click "Organizations" item in sidebar
- Add new list of organizations with following parameters:
  - Key: "organizations" (this must be exactly same or it won't work)
  - Value: "org1||org2||org3" (list of organizations split by double pipe || )
- Organizations are defined for project so every new project can have different set of organizations
- Navigate to board view
- Add organization to tasks by either editing them or creating them and selecting organization from dropdown in modal.

Author
------

- Zdenko Pikula @ IP Security Consulting
- Uses BlueTeck's Metadata Manager as base
- License MIT
